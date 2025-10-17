<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class DeliveriesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    protected $deliveries;
    protected $columns;
    protected $includeHeader;
    protected $includeStats;

    public function __construct($deliveries, $columns, $includeHeader, $includeStats)
    {
        $this->deliveries = $deliveries;
        $this->columns = $columns;
        $this->includeHeader = $includeHeader;
        $this->includeStats = $includeStats;
    }

    /**
     * Return the collection of deliveries to export.
     */
    public function collection()
    {
        $data = new Collection;

        // Thêm thống kê nếu được yêu cầu
        if ($this->includeStats) {
            $data->push([
                'BÁO CÁO TỒN KHO',
            ]);
            $data->push([
                'Ngày xuất: ' . now()->format('d/m/Y H:i:s'),
            ]);
            $data->push([
                'Tổng số lô hàng: ' . $this->deliveries->count(),
            ]);
            $data->push([]); // Dòng trống
        }

        // Thêm dữ liệu lô hàng
        $data = $data->merge($this->deliveries);

        return $data;
    }

    /**
     * Define the headings for the export.
     */
    public function headings(): array
    {
        if (!$this->includeHeader) {
            return [];
        }

        $columnMap = [
            'id' => 'Mã lô hàng',
            'supplier' => 'Nhà cung cấp',
            'product' => 'Sản phẩm',
            'quantity' => 'Số lượng',
            'value' => 'Giá trị',
            'date' => 'Ngày nhập',
            'status' => 'Trạng thái',
        ];

        return array_filter(array_map(function ($col) use ($columnMap) {
            return $columnMap[$col] ?? null;
        }, $this->columns));
    }

    /**
     * Map each row of the collection.
     */
    public function map($delivery): array
    {
        // Nếu là dòng thống kê, trả về nguyên bản
        if (is_array($delivery)) {
            return $delivery;
        }

        $row = [];
        foreach ($this->columns as $col) {
            $value = $delivery->$col;

            if ($col === 'value') {
                $value = number_format($value, 0, ',', '.') . ' VNĐ';
            } elseif ($col === 'date') {
                $value = \Carbon\Carbon::parse($value)->format('d/m/Y');
            } elseif ($col === 'status') {
                $value = match ($value) {
                    'pending' => 'Đang chờ',
                    'completed' => 'Đã nhập kho',
                    'cancelled' => 'Đã hủy',
                    default => $value,
                };
            }

            $row[] = $value;
        }

        return $row;
    }
}