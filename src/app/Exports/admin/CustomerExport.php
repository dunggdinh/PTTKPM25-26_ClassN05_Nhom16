<?php

namespace App\Exports\admin;

use App\Models\admin\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerExport implements FromCollection, WithHeadings
{
    /**
     * Lấy dữ liệu để xuất
     */
    public function collection()
    {
        return Customer::select(
            'user_id',
            'name',
            'email',
            'role',
            'birth_date',
            'gender',
            'phone',
            'address',
            'created_at'
        )->get()->map(function($customer){
            $customer->birth_date = $customer->birth_date ? $customer->birth_date->format('d/m/Y') : '';
            $customer->created_at = $customer->created_at ? $customer->created_at->format('d/m/Y') : '';
            return $customer;
        });
    }


    /**
     * Thêm header cho file Excel
     */
    public function headings(): array
    {
        return [
            'ID',
            'Tên',
            'Email',
            'Vai trò',
            'Ngày sinh',
            'Giới tính',
            'SĐT',
            'Địa chỉ',
            'Ngày tạo'
        ];
    }
}
