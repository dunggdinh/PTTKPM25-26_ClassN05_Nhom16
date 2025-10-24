@extends('admin.layout')
@section('title', 'Quản lý Đổi/Trả hàng')
@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <div class="mb-8 flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Quản Lý Đổi/Trả Hàng</h1>
                <p class="text-gray-600 mt-2">Xử lý và theo dõi các yêu cầu đổi trả từ khách hàng</p>
            </div>
            <div class="flex space-x-2">
                <button type="button" onclick="exportReturns('pdf')" 
                  class="bg-red-600 hover:bg-red-700 text-white border border-red-600 px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v8m-4-4h8M5 19h14a2 2 0 002-2V9.414a2 2 0 00-.586-1.414l-4.414-4.414A2 2 0 0014.586 3H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                  <span>Xuất PDF</span>
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-blue-100">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Chờ xử lý</p>
                        <p class="text-2xl font-semibold text-gray-900" id="pendingCount">{{ $stats['pending'] }}</p>
                   </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-green-100">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Đã duyệt</p>
                        <p class="text-2xl font-semibold text-gray-900" id="approvedCount">{{ $stats['approved'] }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-yellow-100">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Hoàn tất</p>
                        <p class="text-2xl font-semibold text-gray-900" id="completedCount">{{ $stats['completed'] }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-purple-100">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Từ chối</p>
                        <p class="text-2xl font-semibold text-gray-900" id="rejectedCount">{{ $stats['rejected'] }}</p>
                    </div>
                </div>
            </div>
        </div>



            <div class="bg-white rounded-xl shadow-md mb-6">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Danh sách yêu cầu đổi trả</h2>
                    <!-- Bộ lọc và tìm kiếm yêu cầu đổi/trả -->
                    <form method="GET" action="{{ route('admin.return') }}" class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <!-- Ô tìm kiếm -->
                            <div class="flex-1">
                                <div class="relative">
                                    <input type="text" name="search" placeholder="Mã yêu cầu, tên KH, sản phẩm..."
                                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full"
                                        value="{{ request('search') }}">
                                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>

                            <!-- Bộ lọc trạng thái -->
                            <div class="flex-1">
                                <select name="status" onchange="this.form.submit()"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">Tất cả trạng thái</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Đã duyệt</option>
                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Hoàn tất</option>
                                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Từ chối</option>
                                </select>
                            </div>

                            <!-- Bộ lọc loại yêu cầu -->
                            <div class="flex-1">
                                <select name="type" onchange="this.form.submit()"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">Tất cả loại</option>
                                    <option value="Trả hàng" {{ request('type') == 'Trả hàng' ? 'selected' : '' }}>Trả hàng</option>
                                    <option value="Đổi hàng" {{ request('type') == 'Đổi hàng' ? 'selected' : '' }}>Đổi hàng</option>
                                </select>
                            </div>
                        </div>

                          <!-- Nút chức năng -->
                          <div class="flex justify-end space-x-3 mt-6">
                              <!-- Nút thêm yêu cầu-->
                              <button type="button" onclick="openCreateModal()"
                                  class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5 rounded-lg flex items-center space-x-1.5 transition-colors">
                                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" path>
                                  </svg>
                                  <span>Thêm yêu cầu</span>
                              </button>

                              <!-- Nút làm mới -->
                              <a href="{{ route('admin.return.reload') }}"
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

        <!-- Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table id="deliveriesTableMain" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã yêu cầu</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Khách hàng</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sản phẩm</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Loại yêu cầu</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lý do</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày yêu cầu</th>
                            <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($returns as $return)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $return->return_id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col">
                                        <div class="text-sm font-medium text-gray-900">
                                            @if($return->orderItem && $return->orderItem->order && $return->orderItem->order->user)
                                                {{ $return->orderItem->order->user->name }}
                                            @else
                                                N/A
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <div class="text-sm font-medium text-gray-900">
                                            @if($return->orderItem && $return->orderItem->product)
                                                {{ $return->orderItem->product->name }}
                                            @else
                                                N/A
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($return->type === 'Trả hàng')
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                            Trả hàng
                                        </span>
                                    @elseif($return->type === 'Đổi hàng')
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                            Đổi hàng
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                                            {{ $return->type }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <div class="max-w-xs truncate">{{ $return->reason }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full
                                        {{ $return->status === 'Chờ xử lý' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $return->status === 'Đã duyệt' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $return->status === 'Hoàn tất' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $return->status === 'Từ chối' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ $return->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($return->requested_at)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex justify-end space-x-4">
                                        <!-- Nút Sửa -->
                                        <button onclick="openEdit('{{ $return->return_id }}')" 
                                            class="text-blue-600 hover:text-blue-800 text-sm font-medium hover:underline">
                                            Sửa
                                        </button>

                                        <!-- Nút Xóa -->
                                        <button onclick="openDelete('{{ $return->return_id }}')" 
                                            class="text-red-600 hover:text-red-800 text-sm font-medium hover:underline">
                                            Xóa
                                        </button>

                                        <!-- Modal xác nhận xóa -->
                                        <div id="delete-modal-{{ $return->return_id }}" style="display:none;"
                                                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-20">
                                                <div class="bg-white p-4 rounded shadow-md w-80">
                                                    <h3 class="font-semibold mb-2">Xóa yêu cầu: <span class="text-red-600">{{ $return->return_id }}</span></h3>
                                                    <p class="mb-4">Bạn có chắc muốn xóa yêu cầu này?</p>

                                                    <div class="flex justify-end gap-2">
                                                        <form action="{{ route('admin.return.destroy', $return->return_id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Xóa</button>
                                                        </form>
                                                        <button type="button" onclick="closeDelete('{{ $return->return_id }}')" class="px-3 py-1 rounded border hover:bg-gray-100">Hủy</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500 text-sm">Không có đơn hàng nào.</td>
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

<!-- Thư viện xuất Excel & PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.1/jspdf.plugin.autotable.min.js"></script>

<script>
// Hàm xử lý modal tạo mới
function openCreateModal() {
    document.getElementById('createReturnModal').style.display = 'flex';
}

function closeCreateModal() {
    document.getElementById('createReturnModal').style.display = 'none';
}

// Hàm xử lý modal sửa
function openEdit(returnId) {
    document.getElementById('editReturnModal').style.display = 'flex';

    const form = document.getElementById('editReturnForm');
    form.setAttribute('data-id', returnId); // ✅ thêm dòng này

    fetch(`/admin/return/${returnId}/edit`)
        .then(response => response.json())
        .then(data => {
            form.action = `/admin/return/${returnId}`;
            form.querySelector('select[name="status"]').value = data.status;
            form.querySelector('select[name="type"]').value = data.type;
            form.querySelector('textarea[name="reason"]').value = data.reason;
        })
        .catch(() => alert('Không tải được thông tin'));
}


function closeEditModal() {
    document.getElementById('editReturnModal').style.display = 'none';
}

// Hàm xử lý submit form edit
function handleEditSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const returnId = form.getAttribute('data-id');

    if (!returnId) {
        alert('Không xác định được ID yêu cầu.');
        return;
    }

    const submitBtn = form.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner"></span> Đang xử lý...';

    const formData = new FormData(form);

    fetch(`/admin/return/${returnId}`, {
        method: 'POST', // ✅ Giữ POST
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-HTTP-Method-Override': 'PUT' // ✅ Laravel hiểu đây là PUT
        }
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            alert(result.message);
            window.location.reload();
        } else {
            alert(result.message || 'Có lỗi xảy ra');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Có lỗi xảy ra. Vui lòng thử lại.');
    })
    .finally(() => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = 'Cập nhật';
    });
}


// Hàm xử lý modal xóa
function openDelete(returnId) {
    document.getElementById(`delete-modal-${returnId}`).style.display = 'flex';
}

function closeDelete(returnId) {
    document.getElementById(`delete-modal-${returnId}`).style.display = 'none';
}

// Hàm validate form
function validateReturnForm(form) {
    console.log("Validating form...");
    let isValid = true;
    const fields = {
        'customer_id': 'Vui lòng chọn khách hàng',
        'product_id': 'Vui lòng chọn sản phẩm',
        'type': 'Vui lòng chọn loại yêu cầu',
        'reason': 'Vui lòng nhập lý do'
    };

    // Reset all errors first
    form.querySelectorAll('.error-message').forEach(error => {
        error.classList.add('hidden');
    });
    form.querySelectorAll('.border-red-500').forEach(field => {
        field.classList.remove('border-red-500');
    });

    // Validate each field
    Object.keys(fields).forEach(fieldName => {
        const field = form.querySelector(`[name="${fieldName}"]`);
        if (!field) {
            console.log(`Field ${fieldName} not found`);
            return;
        }
        const errorDiv = field.parentElement.querySelector('.error-message');
        console.log(`Checking ${fieldName}:`, field.value);
        
        if (field.tagName.toLowerCase() === 'select') {
            // Kiểm tra select box
            if (!field.value || field.value === "") {
                isValid = false;
                field.classList.add('border-red-500');
                if (errorDiv) {
                    errorDiv.textContent = fields[fieldName];
                    errorDiv.classList.remove('hidden');
                }
            }
        } else {
            // Kiểm tra input text/textarea
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('border-red-500');
                if (errorDiv) {
                    errorDiv.textContent = fields[fieldName];
                    errorDiv.classList.remove('hidden');
                }
            }
        }
    });

    return isValid;
}

// Hàm xuất PDF
function exportReturns(type) {
    if (type === 'pdf') {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Lấy dữ liệu từ bảng
        const table = document.getElementById('deliveriesTableMain');
        
        // Tạo tiêu đề
        doc.setFontSize(16);
        doc.text('Danh sách yêu cầu đổi/trả hàng', 14, 15);
        
        // Xuất bảng
        doc.autoTable({
            html: table,
            startY: 25,
            theme: 'grid',
            styles: {
                fontSize: 8
            },
            columnStyles: {
                0: {cellWidth: 20},  // Mã yêu cầu
                1: {cellWidth: 30},  // Khách hàng
                2: {cellWidth: 30},  // Sản phẩm
                3: {cellWidth: 20},  // Loại yêu cầu
                4: {cellWidth: 35},  // Lý do
                5: {cellWidth: 20},  // Trạng thái
                6: {cellWidth: 25},  // Ngày yêu cầu
            },
        });

        // Tải file PDF
        doc.save('danh-sach-yeu-cau-doi-tra.pdf');
    }
}

// Cập nhật số liệu thống kê realtime
function updateStats() {
    fetch('/admin/return/stats')
        .then(response => response.json())
        .then(data => {
            document.getElementById('pendingCount').textContent = data.pending;
            document.getElementById('approvedCount').textContent = data.approved;
            document.getElementById('completedCount').textContent = data.completed;
            document.getElementById('rejectedCount').textContent = data.rejected;
        })
        .catch(error => console.error('Error:', error));
}

// Thêm sự kiện cho form submit
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
        const submitButton = form.querySelector('button[type="submit"]');
        if (submitButton) {
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner"></span> Đang xử lý...';
        }
    });
});
</script>

<style>
.spinner {
    display: inline-block;
    width: 1rem;
    height: 1rem;
    border: 2px solid #ffffff;
    border-top-color: transparent;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Hiệu ứng cho modals */
.modal-enter {
    animation: modalFadeIn 0.3s ease-out;
}

@keyframes modalFadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}
</style>


<!-- Edit Return Modal -->
<div id="editReturnModal" style="display:none" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-20">
    <div class="bg-white p-6 rounded-lg shadow-xl w-[500px]">
        <h3 class="text-lg font-semibold mb-4">Sửa yêu cầu đổi/trả hàng</h3>
        
        <form id="editReturnForm" class="space-y-4" onsubmit="handleEditSubmit(event)">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            
            <!-- Trạng thái -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Trạng thái <span class="text-red-500">*</span></label>
                <select name="status" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">Chọn trạng thái</option>
                    <option value="Chờ xử lý">Chờ xử lý</option>
                    <option value="Đã duyệt">Đã duyệt</option>
                    <option value="Hoàn tất">Hoàn tất</option>
                    <option value="Từ chối">Từ chối</option>

                </select>
            </div>

            <!-- Loại yêu cầu -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Loại yêu cầu <span class="text-red-500">*</span></label>
                <select name="type" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="Trả hàng">Trả hàng</option>
                    <option value="Đổi hàng">Đổi hàng</option>
                </select>
            </div>

            <!-- Lý do -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Lý do <span class="text-red-500">*</span></label>
                <textarea name="reason" required rows="3"
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                    placeholder="Nhập lý do đổi/trả hàng"></textarea>
            </div>

            <div class="flex justify-end gap-2 pt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Cập nhật
                </button>
                <button type="button" onclick="closeEditModal()" 
                    class="px-4 py-2 rounded-lg border hover:bg-gray-100">
                    Hủy
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Create Return Modal -->
<div id="createReturnModal" style="display:none" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-20">
    <div class="bg-white p-6 rounded-lg shadow-xl w-[500px]">
        <h3 class="text-lg font-semibold mb-4">Tạo yêu cầu đổi/trả hàng</h3>
        
        <form id="createReturnForm" class="space-y-4" onsubmit="handleCreateSubmit(event)">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            @csrf
            
            <!-- Khách hàng -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Khách hàng <span class="text-red-500">*</span></label>
                <select name="customer_id" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">Chọn khách hàng</option>
                    @foreach ($users as $customer)
                        @if($customer->role === 'customer')
                            <option value="{{ $customer->user_id }}">{{ $customer->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- Sản phẩm -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sản phẩm <span class="text-red-500">*</span></label>
                <select name="product_id" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">Chọn sản phẩm</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->product_id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Loại yêu cầu -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Loại yêu cầu <span class="text-red-500">*</span></label>
                <select name="type" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">Chọn loại yêu cầu</option>
                    <option value="Trả hàng">Trả hàng</option>
                    <option value="Đổi hàng">Đổi hàng</option>
                </select>
            </div>

            <!-- Lý do -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Lý do <span class="text-red-500">*</span></label>
                <textarea name="reason" required rows="3"
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                    placeholder="Nhập lý do đổi/trả hàng"></textarea>
            </div>

            <div class="flex justify-end gap-2 pt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Tạo yêu cầu
                </button>
                <button type="button" onclick="closeCreateModal()" 
                    class="px-4 py-2 rounded-lg border hover:bg-gray-100">
                    Hủy
                </button>
            </div>
        </form>
    </div>
</div>

@endsection