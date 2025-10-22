{{-- resources/views/admin/warranty.blade.php --}}
@extends('admin.layout')
@section('title', 'Bảo hành')

@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Quản lý Bảo hành & Lịch hẹn</h1>
            <p class="text-gray-600">Theo dõi và quản lý các yêu cầu bảo hành và lịch hẹn khách hàng</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-600">Tổng yêu cầu</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalWarranty }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-600">Đang xử lý</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $pendingWarranty }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-600">Hoàn thành</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $completedWarranty }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-600">Lịch hẹn hôm nay</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $appointments_today }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Danh sách lịch hẹn</h2>

                <form method="GET" action="{{ route('admin.warranties') }}"
                      class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">

                    <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                        <div class="relative">
                            <input type="text" name="search" placeholder="Tìm kiếm lịch hẹn..."
                                   class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent w-full md:w-64"
                                   value="{{ request('search') }}">
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>

                        {{-- Lọc trạng thái: lưu ý value nên khớp với DB (pending/processing/completed/cancelled) --}}
                        <select name="status" id="status"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Tất cả trạng thái</option>
                            <option value="pending"    {{ request('status') == 'pending' ? 'selected' : '' }}>Đang xử lý</option>
                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Đang thực hiện</option>
                            <option value="completed"  {{ request('status') == 'completed' ? 'selected' : '' }}>Hoàn tất</option>
                            <option value="cancelled"  {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                        </select>

                        {{-- Lọc theo ngày --}}
                        <select name="date" id="date"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="" {{ request('date') == '' ? 'selected' : '' }}>Tất cả</option>
                            <option value="today" {{ request('date') == 'today' ? 'selected' : '' }}>Hôm nay</option>
                            <option value="week"  {{ request('date') == 'week' ? 'selected' : '' }}>Tuần này</option>
                            <option value="month" {{ request('date') == 'month' ? 'selected' : '' }}>Tháng này</option>
                        </select>
                    </div>

                    <div class="flex space-x-3">
                        <button type="button" onclick="exportWarrantyFile('excel')"
                            class="bg-green-600 hover:bg-green-700 text-white border border-green-600 px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>Xuất Excel</span>
                        </button>

                        <button type="button" onclick="exportWarrantyFile('pdf')"
                            class="bg-red-600 hover:bg-red-700 text-white border border-red-600 px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7v10a2 2 0 01-2 2H7a2 2 0 01-2-2V7m0 0l7 7 7-7"/>
                            </svg>
                            <span>Xuất PDF</span>
                        </button>

                        <a href="{{ route('admin.warranties') }}"
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

            <div class="overflow-x-auto">
                <table class="w-full border border-gray-200 rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <input type="checkbox" id="select-all" onchange="toggleSelectAll()" class="text-blue-600 focus:ring-blue-500">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã yêu cầu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Khách hàng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sản phẩm</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã sản phẩm</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vấn đề</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày hẹn</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Giờ hẹn</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ghi chú</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                        </tr>
                    </thead>

                    <tbody id="warrantyTable" class="bg-white divide-y divide-gray-200">
                        @forelse($warranties as $warranty)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <input type="checkbox" name="selected[]" value="{{ $warranty->appointment_id }}" class="text-blue-600 focus:ring-blue-500">
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $warranty->appointment_id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $warranty->user->name ?? 'Không xác định' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $warranty->warranty->product->name ?? 'Sản phẩm không tồn tại' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $warranty->warranty->product_serial ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $warranty->service_type }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ \Carbon\Carbon::parse($warranty->appointment_date)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $warranty->appointment_time }}</td>

                                <td class="px-6 py-4 text-sm">
                                    @php
                                        $status = trim($warranty->status);
                                        $statusColors = [
                                            'pending'    => 'bg-yellow-100 text-yellow-800',
                                            'processing' => 'bg-blue-100 text-blue-800',
                                            'completed'  => 'bg-green-100 text-green-800',
                                            'cancelled'  => 'bg-red-100 text-red-800',
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ $status }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">{{ $warranty->notes }}</td>

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <div class="flex space-x-2">
                                        <!-- Edit -->
                                        <div>
                                            <button onclick="openEdit('{{ $warranty->appointment_id }}')" class="text-blue-600 hover:underline">Sửa</button>
                                            <div id="edit-modal-{{ $warranty->appointment_id }}" style="display:none;"
                                                 class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-20">
                                                <div class="bg-white p-4 rounded shadow-md w-80">
                                                    <h3 class="font-semibold mb-2">Cập nhật trạng thái yêu cầu: <span class="text-blue-600">{{ $warranty->warranty_code }}</span></h3>
                                                    <form action="{{ route('admin.warranties.updateStatus', $warranty->appointment_id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <select name="status" class="border rounded px-2 py-1 mb-4 w-full">
                                                            <option value="pending"    {{ $warranty->status=='pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                                            <option value="processing" {{ $warranty->status=='processing' ? 'selected' : '' }}>Đang xử lý</option>
                                                            <option value="completed"  {{ $warranty->status=='completed' ? 'selected' : '' }}>Hoàn tất</option>
                                                            <option value="cancelled"  {{ $warranty->status=='cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                                        </select>
                                                        <div class="flex justify-end gap-2">
                                                            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Cập nhật</button>
                                                            <button type="button" onclick="closeEdit('{{ $warranty->appointment_id }}')" class="px-3 py-1 rounded border hover:bg-gray-100">Hủy</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete -->
                                        <div>
                                            <button onclick="openDelete('{{ $warranty->appointment_id }}')" class="text-red-600 hover:underline">Xóa</button>
                                            <div id="delete-modal-{{ $warranty->appointment_id }}" style="display:none;"
                                                 class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-20">
                                                <div class="bg-white p-4 rounded shadow-md w-80">
                                                    <h3 class="font-semibold mb-2">Xóa yêu cầu: <span class="text-red-600">{{ $warranty->warranty_id }}</span></h3>
                                                    <p class="mb-4">Bạn có chắc muốn xóa yêu cầu này?</p>
                                                    <div class="flex justify-end gap-2">
                                                        <form action="{{ route('admin.warranties.destroy', $warranty->appointment_id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Xóa</button>
                                                        </form>
                                                        <button type="button" onclick="closeDelete('{{ $warranty->appointment_id }}')" class="px-3 py-1 rounded border hover:bg-gray-100">Hủy</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="px-6 py-4 text-center text-gray-500 text-sm">Không có yêu cầu bảo hành nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Phân trang -->
                <div class="flex flex-col items-center mt-4 bg-white px-4 py-2 rounded-b-xl">
                    <div>
                        {{ $warranties->withQueryString()->links('pagination::simple-tailwind') }}
                    </div>
                    <div class="text-sm text-gray-500 mt-1">
                        Trang {{ $warranties->currentPage() }} / {{ $warranties->lastPage() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<!-- SheetJS (Excel) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js" referrerpolicy="no-referrer"></script>

<!-- jsPDF + AutoTable (PDF) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.1/jspdf.plugin.autotable.min.js"></script>

<script>
async function exportWarrantyFile(type) {
    const table = document.querySelector("table");
    if (!table) return alert("Không tìm thấy bảng dữ liệu bảo hành!");

    // Lấy tiêu đề và dữ liệu
    const headers = Array.from(table.querySelectorAll("thead th"))
        .map(th => th.innerText.trim())
        .filter(h => !h.toLowerCase().includes("thao tác") && h !== "");
    const rows = Array.from(table.querySelectorAll("tbody tr")).map(tr =>
        Array.from(tr.querySelectorAll("td")).map(td => td.innerText.trim())
    ).filter(r => r.length > 0);

    // Bỏ cột đầu (checkbox)
    headers.shift();
    rows.forEach(r => r.shift());

    const fileName = `BaoHanh_LichHen_${new Date().toISOString().slice(0,10)}`;

    // Excel
    if (type === 'excel') {
        const wb = XLSX.utils.book_new();
        const ws = XLSX.utils.aoa_to_sheet([headers, ...rows]);
        XLSX.utils.book_append_sheet(wb, ws, "Warranty");
        XLSX.writeFile(wb, `${fileName}.xlsx`);
        return;
    }

    // PDF
    if (type === 'pdf') {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF({ orientation: 'landscape', unit: 'pt', format: 'a4' });

        // Load font từ CDN
        await loadFont(doc);

        doc.setFont("SerifVN");
        doc.setFontSize(14);
        doc.text("Danh sách bảo hành & lịch hẹn", 40, 30);

        doc.autoTable({
            startY: 45,
            head: [headers],
            body: rows,
            theme: 'grid',
            styles: { font: "SerifVN", fontSize: 9 },
            headStyles: { fillColor: [59,130,246], textColor: 255 },
        });

        doc.save(`${fileName}.pdf`);
    }
}

// Font Unicode (tải từ CDN, không cần cài ttf local)
async function loadFont(doc) {
    const url = "https://cdn.jsdelivr.net/gh/googlefonts/noto-fonts@main/hinted/ttf/NotoSerif/NotoSerif-Regular.ttf";
    const buf = await fetch(url).then(r => r.arrayBuffer());
    const bytes = new Uint8Array(buf);
    let bin = ""; for (let i=0; i<bytes.length; i++) bin += String.fromCharCode(bytes[i]);
    const base64 = btoa(bin);
    doc.addFileToVFS("SerifVN.ttf", base64);
    doc.addFont("SerifVN.ttf", "SerifVN", "normal");
}
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.querySelector("input[name='search']");
    const statusFilter = document.querySelector("select[name='status']");
    const dateFilter = document.querySelector("select[name='date']");
    const reloadBtn = document.getElementById("reload-btn");
    const tableBody = document.getElementById("warrantyTable");

    [statusFilter, dateFilter].forEach(select => {
        if (select) select.addEventListener("change", applyFilters);
    });

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
        if (searchInput) params.set("search", searchInput.value || '');
        if (statusFilter) params.set("status", statusFilter.value || '');
        if (dateFilter) params.set("date", dateFilter.value || '');
        window.location.search = params.toString();
    }

    if (reloadBtn && tableBody) {
        reloadBtn.addEventListener("click", async function(e) {
            e.preventDefault();
            tableBody.innerHTML = `<tr><td colspan="11" class="text-center py-4">Đang tải dữ liệu...</td></tr>`;
            try {
                const response = await fetch(this.dataset.url, { headers: { "X-Requested-With": "XMLHttpRequest" } });
                const data = await response.json();
                tableBody.innerHTML = data.html || `<tr><td colspan="11" class="text-center text-red-500">Không có dữ liệu.</td></tr>`;
            } catch (error) {
                tableBody.innerHTML = `<tr><td colspan="11" class="text-center text-red-500">Lỗi khi tải dữ liệu.</td></tr>`;
            }
        });
    }
});

function openEdit(id){ document.getElementById('edit-modal-'+id).style.display='flex'; }
function closeEdit(id){ document.getElementById('edit-modal-'+id).style.display='none'; }
function openDelete(id){ document.getElementById('delete-modal-'+id).style.display='flex'; }
function closeDelete(id){ document.getElementById('delete-modal-'+id).style.display='none'; }
</script>
@endsection
