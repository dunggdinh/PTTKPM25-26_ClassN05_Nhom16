@extends('admin.layout')

@section('content')
<div class="min-h-full p-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Thêm Lô Hàng Mới</h1>
    <p class="text-gray-600 mb-6">Nhập thông tin lô hàng nhập kho</p>

    <form action="{{ route('admin.deliveries.store') }}" method="POST" class="bg-white rounded-lg shadow-sm p-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="code" class="block text-sm font-medium text-gray-700">Mã lô hàng</label>
                <input type="text" name="code" id="code" class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                @error('code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="supplier" class="block text-sm font-medium text-gray-700">Nhà cung cấp</label>
                <select name="supplier" id="supplier" class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">Chọn nhà cung cấp</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier }}">{{ $supplier }}</option>
                    @endforeach
                </select>
                @error('supplier') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="product" class="block text-sm font-medium text-gray-700">Sản phẩm</label>
                <input type="text" name="product" id="product" class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                @error('product') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-700">Số lượng</label>
                <input type="number" name="quantity" id="quantity" class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required min="1">
                @error('quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="value" class="block text-sm font-medium text-gray-700">Giá trị (VNĐ)</label>
                <input type="number" name="value" id="value" class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required min="0">
                @error('value') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Ngày nhập</label>
                <input type="date" name="date" id="date" class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Trạng thái</label>
                <select name="status" id="status" class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="pending">Đang chờ</option>
                    <option value="completed">Đã nhập kho</option>
                    <option value="cancelled">Đã hủy</option>
                </select>
                @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mt-6 flex justify-end gap-3">
            <a href="{{ route('admin.deliveries.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Hủy</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Thêm lô hàng</button>
        </div>
    </form>
</div>
@endsection