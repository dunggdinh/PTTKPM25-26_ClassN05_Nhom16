<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class InventoryExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents
{
    protected $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function collection()
    {
        $query = Product::query();

        // Áp dụng bộ lọc
        if ($this->params['range'] === 'current') {
            if ($search = $this->params['search'] ?? '') {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('sku', 'like', "%{$search}%");
            }
            if ($category = $this->params['category'] ?? '') {
                $query->where('category', $category);
            }
            if ($status = $this->params['status'] ?? '') {
                if ($status === 'in-stock') {
                    $query->where('stock', '>', DB::raw('min_stock'));
                } elseif ($status === 'low-stock') {
                    $query->where('stock', '<=', DB::raw('min_stock'))->where('stock', '>', 0);
                } elseif ($status === 'out-of-stock') {
                    $query->where('stock', 0);
                }
            }
        } elseif ($this->params['range'] === 'selected') {
            $query->whereIn('id', $this->params['selected_ids'] ?? []);
        }

        // Bộ lọc trạng thái
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
        if (in_array('name', $columns)) $headings[] = 'Tên sản phẩm';
        if (in_array('sku', $columns)) $headings[] = 'Mã SKU';
        if (in_array('category', $columns)) $headings[] = 'Danh mục';
        if (in_array('brand', $columns)) $headings[] = 'Thương hiệu';
        if (in_array('stock', $columns)) $headings[] = 'Tồn kho';
        if (in_array('min_stock', $columns)) $headings[] = 'Tối thiểu';
        if (in_array('status', $columns)) $headings[] = 'Trạng thái';
        if (in_array('price', $columns)) $headings[] = 'Giá (VNĐ)';
        if (in_array('supplier', $columns)) $headings[] = 'Nhà cung cấp';
        if (in_array('location', $columns)) $headings[] = 'Vị trí kho';

        return $headings;
    }

    public function map($product): array
    {
        $columns = $this->params['columns'] ?? [];
        $row = [];

        if (in_array('id', $columns)) $row[] = $product->id;
        if (in_array('name', $columns)) $row[] = $product->name;
        if (in_array('sku', $columns)) $row[] = $product->sku;
        if (in_array('category', $columns)) $row[] = $this->getCategoryName($product->category);
        if (in_array('brand', $columns)) $row[] = $product->brand;
        if (in_array('stock', $columns)) $row[] = $product->stock;
        if (in_array('min_stock', $columns)) $row[] = $product->min_stock;
        if (in_array('status', $columns)) $row[] = $this->getStatusText($product->status);
        if (in_array('price', $columns)) $row[] = number_format($product->price, 0, ',', '.') . '₫';
        if (in_array('supplier', $columns)) $row[] = $product->supplier;
        if (in_array('location', $columns)) $row[] = $product->location;

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
                    $sheet->setCellValue("A{$currentRow}", 'BÁO CÁO TỒN KHO');
                    $currentRow++;
                    $sheet->setCellValue("A{$currentRow}", 'Ngày xuất: ' . now()->format('d/m/Y H:i:s'));
                    $currentRow += 2;
                }

                if ($this->params['include_stats'] ?? false) {
                    $collection = $this->collection();
                    $total = $collection->count();
                    $inStock = $collection->where('status', 'in-stock')->count();
                    $lowStock = $collection->where('status', 'low-stock')->count();
                    $outOfStock = $collection->where('status', 'out-of-stock')->count();

                    $sheet->setCellValue("A{$currentRow}", 'THỐNG KÊ TỔNG QUAN:');
                    $currentRow++;
                    $sheet->setCellValue("A{$currentRow}", "Tổng sản phẩm: {$total}");
                    $currentRow++;
                    $sheet->setCellValue("A{$currentRow}", "Còn hàng: {$inStock}");
                    $currentRow++;
                    $sheet->setCellValue("A{$currentRow}", "Sắp hết: {$lowStock}");
                    $currentRow++;
                    $sheet->setCellValue("A{$currentRow}", "Hết hàng: {$outOfStock}");
                    $currentRow += 2;
                }

                // Điều chỉnh vị trí bắt đầu của dữ liệu
                if ($currentRow > 1) {
                    $sheet->getParent()->getActiveSheet()->getStyle("A1:A{$currentRow}")->getFont()->setBold(true);
                }
            }
        ];
    }

    private function getCategoryName($category)
    {
        $categories = [
            'smartphone' => 'Điện thoại',
            'laptop' => 'Laptop',
            'tablet' => 'Tablet',
            'accessory' => 'Phụ kiện',
        ];
        return $categories[$category] ?? $category;
    }

    private function getStatusText($status)
    {
        $statuses = [
            'in-stock' => 'Còn hàng',
            'low-stock' => 'Sắp hết',
            'out-of-stock' => 'Hết hàng',
        ];
        return $statuses[$status] ?? $status;
    }
}