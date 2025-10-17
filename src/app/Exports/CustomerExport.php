<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeWriting;

class CustomerExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents
{
    protected $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function collection()
    {
        $query = Customer::query();

        if ($this->params['range'] === 'current') {
            if ($search = $this->params['search'] ?? '') {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
            }
            if ($status = $this->params['status'] ?? '') {
                $query->where('status', $status);
            }
        } elseif ($this->params['range'] === 'selected') {
            $query->whereIn('id', $this->params['selected_ids'] ?? []);
        }

        if (!empty($this->params['statuses'])) {
            $query->whereIn('status', $this->params['statuses']);
        }

        return $query->get();
    }

    public function headings(): array
    {
        $columns = $this->params['columns'] ?? [];
        $headings = [];

        if (in_array('id', $columns)) $headings[] = 'ID';
        if (in_array('name', $columns)) $headings[] = 'Tên khách hàng';
        if (in_array('email', $columns)) $headings[] = 'Email';
        if (in_array('phone', $columns)) $headings[] = 'Số điện thoại';
        if (in_array('address', $columns)) $headings[] = 'Địa chỉ';
        if (in_array('status', $columns)) $headings[] = 'Trạng thái';
        if (in_array('total_orders', $columns)) $headings[] = 'Tổng đơn hàng';
        if (in_array('last_order_date', $columns)) $headings[] = 'Ngày đặt hàng cuối';
        if (in_array('notes', $columns)) $headings[] = 'Ghi chú';

        return $headings;
    }

    public function map($customer): array
    {
        $columns = $this->params['columns'] ?? [];
        $row = [];

        if (in_array('id', $columns)) $row[] = $customer->id;
        if (in_array('name', $columns)) $row[] = $customer->name;
        if (in_array('email', $columns)) $row[] = $customer->email;
        if (in_array('phone', $columns)) $row[] = $customer->phone;
        if (in_array('address', $columns)) $row[] = $customer->address;
        if (in_array('status', $columns)) $row[] = $customer->status === 'active' ? 'Hoạt động' : 'Không hoạt động';
        if (in_array('total_orders', $columns)) $row[] = $customer->total_orders;
        if (in_array('last_order_date', $columns)) $row[] = $customer->last_order_date ? $customer->last_order_date->format('d/m/Y') : 'N/A';
        if (in_array('notes', $columns)) $row[] = $customer->notes ?? 'N/A';

        return $row;
    }

    public function registerEvents(): array
    {
        return [
            BeforeWriting::class => function (BeforeWriting $event) {
                $spreadsheet = $event->writer->getDelegate();
                $sheet = $spreadsheet->getActiveSheet();
                $currentRow = 1;

                if ($this->params['include_timestamp'] ?? false) {
                    $sheet->setCellValue("A{$currentRow}", 'BÁO CÁO KHÁCH HÀNG');
                    $currentRow++;
                    $sheet->setCellValue("A{$currentRow}", 'Ngày xuất: ' . now()->format('d/m/Y H:i:s'));
                    $currentRow += 2;
                }

                if ($this->params['include_stats'] ?? false) {
                    $collection = $this->collection();
                    $total = $collection->count();
                    $active = $collection->where('status', 'active')->count();
                    $inactive = $collection->where('status', 'inactive')->count();

                    $sheet->setCellValue("A{$currentRow}", 'THỐNG KÊ TỔNG QUAN:');
                    $currentRow++;
                    $sheet->setCellValue("A{$currentRow}", "Tổng khách hàng: {$total}");
                    $currentRow++;
                    $sheet->setCellValue("A{$currentRow}", "Hoạt động: {$active}");
                    $currentRow++;
                    $sheet->setCellValue("A{$currentRow}", "Không hoạt động: {$inactive}");
                    $currentRow += 2;
                }
            }
        ];
    }
}