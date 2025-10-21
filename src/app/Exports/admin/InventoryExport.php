<?php
namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InventoryExport implements FromCollection, WithHeadings
{
    protected $columns;

    public function __construct($columns)
    {
        $this->columns = $columns;
    }

    public function collection()
    {
        return Product::with(['category', 'supplier'])
            ->get()
            ->map(function ($p) {
                return [
                    'product_id' => $p->product_id,
                    'name'       => $p->name,
                    'brand'      => $p->brand,
                    'category'   => $p->category->name ?? '',
                    'quantity'   => $p->quantity,
                    'status'     => $p->quantity == 0 ? 'Hết hàng' : ($p->quantity < 10 ? 'Sắp hết' : 'Còn hàng'),
                    'price'      => $p->price,
                    'warranty'   => $p->warranty,
                    'supplier'   => $p->supplier->name ?? '',
                ];
            })->map(function ($row) {
                return collect($row)->only($this->columns);
            });
    }

    public function headings(): array
    {
        return [
            'product_id' => 'Mã SP',
            'name' => 'Tên sản phẩm',
            'brand' => 'Hãng',
            'category' => 'Danh mục',
            'quantity' => 'Số lượng',
            'status' => 'Trạng thái',
            'price' => 'Giá',
            'warranty' => 'Bảo hành',
            'supplier' => 'Nhà cung cấp',
        ];
    }
}
