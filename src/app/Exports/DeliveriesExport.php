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
        // Lọc các cột hợp lệ dựa trên model
        $validColumns = ['id', 'code', 'supplier', 'product', 'quantity', 'value', 'date', 'status'];
        $this->columns = array_intersect($columns, $validColumns);
        $this->includeHeader = $includeHeader;
        $this->includeStats = $includeStats;
    }

    public function collection()
    {
        $data = new Collection;

        if ($this->includeStats) {
            $data->push(['BÁO CÁO LÔ HÀNG']);
            $data->push(['Ngày xuất: ' . now()->format('d/m/Y H:i:s')]);
            $data->push(['Tổng số lô hàng: ' . $this->deliveries->count()]);
            $data->push([]); // Dòng trống
        }

        $data = $data->merge($this->deliveries);

        return $data;
    }

    public function headings(): array
    {
        if (!$this->includeHeader) {
            return [];
        }

        $columnMap = [
            'id' => 'Mã lô hàng',
            'code' => 'Mã lô hàng',
            'supplier' => 'Nhà cung cấp',
            'product' => 'Sản phẩm',
            'quantity' => 'Số lượng',
            'value' => 'Giá trị (VNĐ)',
            'date' => 'Ngày nhập',
            'status' => 'Trạng thái',
        ];

        return array_map(function ($col) use ($columnMap) {
            return $columnMap[$col] ?? $col;
        }, $this->columns);
    }

    public function map($delivery): array
    {
        if (is_array($delivery)) {
            return $delivery;
        }

        $row = [];
        foreach ($this->columns as $col) {
            $value = $delivery->$col ?? '';

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