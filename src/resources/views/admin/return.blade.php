@extends('admin.layout')
@section('title', 'Quản lý hàng lỗi')
@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-4xl font-bold text-gray-900">Quản lý Đổi/Trả hàng</h1>
            <p class="text-gray-600 mt-1">Xử lý các yêu cầu đổi trả từ khách hàng</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-yellow-100">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Chờ xử lý</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $pendingRequest }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-blue-100">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Đang xử lý</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $processingRequest }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-green-100">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Hoàn thành</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $completedRequest }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-red-100">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Từ chối</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $rejectedRequest }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
            <div class="bg-white rounded-xl shadow-md">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Danh sách yêu cầu</h2>
                    <!-- Filters and Search -->
                        <form method="GET" action="{{ route('admin.return') }}" 
                            class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">

                            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                                <div class="relative">
                                    <input type="text" name="search" placeholder="Tìm kiếm khách hàng..." 
                                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent w-full md:w-64"
                                        value="{{ request('search') }}">
                                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <select name="status" 
                                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                    <option value="">Tất cả trạng thái</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Hoàn tất</option>
                                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Từ chối</option>
                                </select>
                                <select name="date" 
                                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                    <option value="">Tất cả</option>
                                    <option value="today" {{ request('date') == 'today' ? 'selected' : '' }}>Hôm nay</option>
                                    <option value="week" {{ request('date') == 'week' ? 'selected' : '' }}>Tuần này</option>
                                    <option value="month" {{ request('date') == 'month' ? 'selected' : '' }}>Tháng này</option>
                                </select>
                                <select name="type" 
                                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                    <option value="">Tất cả loại</option>
                                    <option value="change" {{ request('type') == 'change' ? 'selected' : '' }}>Đổi hàng</option>
                                    <option value="return" {{ request('type') == 'return' ? 'selected' : '' }}>Trả hàng</option>
                                </select>
                            </div>
                            <div class="flex space-x-3">
                                <button onclick="exportInventory()" class="bg-green-600 hover:bg-green-700 text-white border border-green-600 px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span>Xuất Excel</span>
                                </button>

                                <a href="{{ route('admin.return') }}"
                                    class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                    <span>Làm mới</span>
                                </a>
                            </div>
                        </form>
                </div>
            </div>

        <!-- Returns/Exchanges Table -->
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-200 rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã yêu cầu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Khách hàng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Loại</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lý do</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày tạo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                        </tr>
                    </thead>

                    <tbody id="returnTable" class="bg-white divide-y divide-gray-200">
                        @forelse ($returns as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $item->return_id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $item->orderItem->order->user->name ?? 'Không xác định' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $item->type }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $item->reason }}</td>
                            <td class="px-6 py-4 text-sm">
                                @php
                                    $statusColors = [
                                        'Chờ xử lý' => 'bg-yellow-100 text-yellow-700',
                                        'Đang xử lý' => 'bg-blue-100 text-blue-700',
                                        'Hoàn tất', 'Đã duyệt' => 'bg-green-100 text-green-700',
                                        'Từ chối' => 'bg-red-100 text-red-700',
                                    ];
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$item->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ \Carbon\Carbon::parse($item->requested_at)->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 flex space-x-2">
                                <!-- Nút Sửa trạng thái -->
                                <div>
                                    <button onclick="openEdit('{{ $item->return_id  }}')" class="text-blue-600 hover:underline">Sửa</button>
                                    <div id="edit-modal-{{ $item->return_id  }}" style="display:none;"
                                        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-20">
                                        <div class="bg-white p-4 rounded shadow-md w-80">
                                            <h3 class="font-semibold mb-2">Cập nhật trạng thái: <span class="text-blue-600">{{ $item->return_id }}</span></h3>
                                            <form action="{{ route('admin.return.update', $item->return_id ) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" class="border rounded px-2 py-1 mb-4 w-full">
                                                    <option value="Chờ xử lý" {{ $item->status=='Chờ xử lý' ? 'selected' : '' }}>Chờ xử lý</option>
                                                    <option value="Đang xử lý" {{ $item->status=='Đang xử lý' ? 'selected' : '' }}>Đang xử lý</option>
                                                    <option value="Hoàn tất" {{ $item->status=='Hoàn tất' ? 'selected' : '' }}>Hoàn tất</option>
                                                    <option value="Từ chối" {{ $item->status=='Từ chối' ? 'selected' : '' }}>Từ chối</option>
                                                </select>
                                                <div class="flex justify-end gap-2">
                                                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Cập nhật</button>
                                                    <button type="button" onclick="closeEdit('{{ $item->return_id  }}')" class="px-3 py-1 rounded border hover:bg-gray-100">Hủy</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Nút Xóa -->
                                <div>
                                    <button onclick="openDelete('{{ $item->return_id  }}')" class="text-red-600 hover:underline">Xóa</button>
                                    <div id="delete-modal-{{ $item->return_id  }}" style="display:none;"
                                        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-20">
                                        <div class="bg-white p-4 rounded shadow-md w-80">
                                            <h3 class="font-semibold mb-2">Xóa yêu cầu: <span class="text-red-600">{{ $item->return_id }}</span></h3>
                                            <p class="mb-4">Bạn có chắc muốn xóa yêu cầu này?</p>
                                            <div class="flex justify-end gap-2">
                                                <form action="{{ route('admin.return.destroy', $item->return_id ) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Xóa</button>
                                                </form>
                                                <button type="button" onclick="closeDelete('{{ $item->return_id  }}')" class="px-3 py-1 rounded border hover:bg-gray-100">Hủy</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500 text-sm">Không có yêu cầu đổi trả nào.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="flex flex-col items-center mt-4 bg-white px-4 py-2 rounded-b-xl">
                    <div>
                        {{ $returns->withQueryString()->links('pagination::simple-tailwind') }}
                    </div>
                    <div class="text-sm text-gray-500 mt-1">
                        Trang {{ $returns->currentPage() }} / {{ $returns->lastPage() }}
                    </div>
                </div>
            </div>
        </div>  
    </div>       
<script>
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.querySelector("input[name='search']");
    const statusFilter = document.querySelector("select[name='status']");
    const dateFilter = document.querySelector("select[name='date']");
    const reloadBtn = document.getElementById("reload-btn"); // nếu có nút reload
    const tableBody = document.getElementById("returnTable");

    // --- Lọc dữ liệu khi thay đổi trạng thái hoặc ngày ---
    [statusFilter, dateFilter].forEach(select => {
        if (select) {
            select.addEventListener("change", () => applyFilters());
        }
    });

    // --- Lọc theo search khi nhấn Enter ---
    if (searchInput) {
        searchInput.addEventListener("keypress", function(e) {
            if (e.key === "Enter") {
                e.preventDefault();
                applyFilters();
            }
        });
    }

    function applyFilters() {
        const params = new URLSearchParams(window.location.search);
        params.set("search", searchInput?.value || '');
        params.set("status", statusFilter?.value || '');
        params.set("date", dateFilter?.value || '');
        window.location.search = params.toString();
    }

    // --- AJAX reload bảng ---
    if (reloadBtn) {
        reloadBtn.addEventListener("click", async function(e) {
            e.preventDefault();
            tableBody.innerHTML = `<tr><td colspan="8" class="text-center py-4">Đang tải dữ liệu...</td></tr>`;
            try {
                const response = await fetch(this.dataset.url, {
                    headers: { "X-Requested-With": "XMLHttpRequest" }
                });
                const data = await response.json();
                tableBody.innerHTML = data.html || `<tr><td colspan="8" class="text-center text-red-500">Không có dữ liệu.</td></tr>`;
            } catch (error) {
                tableBody.innerHTML = `<tr><td colspan="8" class="text-center text-red-500">Lỗi khi tải dữ liệu.</td></tr>`;
            }
        });
    }
});

// --- Mở/Đóng modal chỉnh sửa trạng thái ---
function openEdit(id) {
    document.getElementById('edit-modal-' + id).style.display = 'flex';
}
function closeEdit(id) {
    document.getElementById('edit-modal-' + id).style.display = 'none';
}

// --- Mở/Đóng modal xóa ---
function openDelete(id) {
    document.getElementById('delete-modal-' + id).style.display = 'flex';
}
function closeDelete(id) {
    document.getElementById('delete-modal-' + id).style.display = 'none';
}
</script>


</div>
</html>
@endsection