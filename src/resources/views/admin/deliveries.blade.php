@extends('admin.layout')
@section('title', 'Quản lý nhập hàng')
@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Quản Lý Hàng Nhập</h1>
            <p class="text-gray-600">Theo dõi và quản lý các lô hàng nhập kho</p>
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
                        <p class="text-sm font-medium text-gray-600">Tổng lô hàng</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalBatches }}</p>
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
                        <p class="text-sm font-medium text-gray-600">Đã nhập kho</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $completedBatches }}</p>
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
                        <p class="text-sm font-medium text-gray-600">Đang chờ</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $pendingBatches }}</p>
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
                        <p class="text-sm font-medium text-gray-600">Tổng giá trị</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalValue }}</p>
                    </div>
                </div>
            </div>
        </div>



            <div class="bg-white rounded-xl shadow-md">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Danh sách lô hàng</h2>
                    <!-- Filters and Search -->
                        <form method="GET" action="{{ route('admin.deliveries') }}" 
                            class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">

                            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                                <div class="relative">
                                    <input type="text" name="search" placeholder="Tìm kiếm lô hàng..." 
                                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent w-full md:w-64"
                                        value="{{ request('search') }}">
                                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>

                                <!-- Bộ lọc trạng thái -->
                                <select name="status" onchange="this.form.submit()"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Tất cả trạng thái</option>
                                    <option value="Chờ xử lý" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                    <option value="Hoàn thành" {{ request('status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                    <option value="Đã hủy" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                </select>

                    <!-- Bộ lọc nhà cung cấp -->
                                <select name="supplier" onchange="this.form.submit()" 
                                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">Tất cả nhà cung cấp</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->supplier_id }}" 
                                            {{ request('supplier') == $supplier->supplier_id ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="flex space-x-3">
                                <!-- Xuất Excel -->
                                <button type="button" onclick="exportDeliveriesFile('excel')" 
                                    class="bg-green-600 hover:bg-green-700 text-white border border-green-600 px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span>Xuất Excel</span>
                                </button>

                                <!-- Xuất PDF -->
                                <button type="button" onclick="exportDeliveriesFile('pdf')" 
                                    class="bg-red-600 hover:bg-red-700 text-white border border-red-600 px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v8m-4-4h8M5 19h14a2 2 0 002-2V9.414a2 2 0 00-.586-1.414l-4.414-4.414A2 2 0 0014.586 3H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>Xuất PDF</span>
                                </button>

                                <a href="{{ route('admin.deliveries') }}"
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

        <!-- Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table id="deliveriesTableMain" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã lô hàng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nhà cung cấp</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sản phẩm</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số lượng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Giá</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tổng giá trị</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày nhập</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($batches as $delivery)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $delivery->batch_id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $delivery->supplier->name ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $delivery->product->name ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $delivery->quantity }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ number_format($delivery->price, 0, ',', '.') }} ₫</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ number_format($delivery->total_value, 0, ',', '.') }} ₫</td>
                                <td class="px-6 py-4 text-sm">
                                    @php $status = strtolower(trim($delivery->status)); @endphp

                                    <span class="px-3 py-1 rounded-full text-xs font-medium
                                        @if($status == 'chờ xử lý') bg-yellow-100 text-yellow-800
                                        @elseif($status == 'hoàn thành') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($status) }}
                                    </span>

                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $delivery->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <div class="flex space-x-2">
                                        <!-- Nút Sửa -->
                                        <div>
                                            <button onclick="openEdit('{{ $delivery->batch_id }}')" class="text-blue-600 hover:underline">Sửa</button>

                                            <!-- Modal chỉnh trạng thái -->
                                            <div id="edit-modal-{{ $delivery->batch_id }}" style="display:none;"
                                                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-20">
                                                <div class="bg-white p-4 rounded shadow-md w-80">
                                                    <h3 class="font-semibold mb-2">Cập nhật trạng thái cho lô hàng: <span class="text-blue-600">{{ $delivery->batch_id }}</span></h3>

                                                    <form action="{{ route('admin.deliveries.updateStatus', $delivery->batch_id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <select name="status" class="border rounded px-2 py-1 mb-4 w-full">
                                                            <option value="Chờ xử lý" {{ $delivery->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                                            <option value="Hoàn thành" {{ $delivery->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                                            <option value="Đã hủy" {{ $delivery->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                                      </select>

                                                        <div class="flex justify-end gap-2">
                                                            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Cập nhật</button>
                                                            <button type="button" onclick="closeEdit('{{ $delivery->batch_id }}')" class="px-3 py-1 rounded border hover:bg-gray-100">Hủy</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Nút Xóa -->
                                        <div>
                                            <button onclick="openDelete('{{ $delivery->batch_id }}')" class="text-red-600 hover:underline">Xóa</button>

                                            <!-- Modal xác nhận xóa -->
                                            <div id="delete-modal-{{ $delivery->batch_id }}" style="display:none;"
                                                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-20">
                                                <div class="bg-white p-4 rounded shadow-md w-80">
                                                    <h3 class="font-semibold mb-2">Xóa đơn: <span class="text-red-600">{{ $delivery->batch_id }}</span></h3>
                                                    <p class="mb-4">Bạn có chắc muốn xóa lô hàng này?</p>

                                                    <div class="flex justify-end gap-2">
                                                        <form action="{{ route('admin.deliveries.destroy', $delivery->batch_id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Xóa</button>
                                                        </form>
                                                        <button type="button" onclick="closeDelete('{{ $delivery->batch_id }}')" class="px-3 py-1 rounded border hover:bg-gray-100">Hủy</button>
                                                    </div>
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
                            {{ $batches->withQueryString()->links('pagination::simple-tailwind') }}
                        </div>
                        <div class="text-sm text-gray-500 mt-1">
                            Trang {{ $batches->currentPage() }} / {{ $batches->lastPage() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

<!-- Thư viện xuất Excel & PDF (chỉ load 1 lần ở trang này) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.1/jspdf.plugin.autotable.min.js"></script>

<script>
async function loadCDNFont(doc) {
  const sources = [
    "https://cdn.jsdelivr.net/gh/googlefonts/noto-fonts@main/hinted/ttf/NotoSerif/NotoSerif-Regular.ttf",
    "https://cdn.jsdelivr.net/gh/dejavu-fonts/dejavu-fonts-ttf@version_2_37/ttf/DejaVuSerif.ttf"
  ];
  let base64 = null, postName = "SerifVN";
  for (const url of sources) {
    try {
      const buf = await fetch(url, {mode:'cors'}).then(r => r.arrayBuffer());
      const bytes = new Uint8Array(buf);
      let bin = ""; for (let i=0;i<bytes.length;i++) bin += String.fromCharCode(bytes[i]);
      base64 = btoa(bin); break;
    } catch(e) {}
  }
  if (!base64) { alert("Không tải được font từ CDN. PDF có thể lỗi tiếng Việt."); return; }
  doc.addFileToVFS(postName + ".ttf", base64);
  doc.addFont(postName + ".ttf", postName, "normal");
  doc.setFont(postName);
}

// ===== Chuẩn hoá Unicode về NFC + bỏ NBSP (tránh vỡ dấu) =====
function vn(t) {
  if (t === null || t === undefined) return '';
  try { t = t.toString().normalize('NFC'); } catch {}
  return t.replace(/\u00A0/g, ' ');
}

// ===== Lấy dữ liệu từ bảng (Deliveries) =====
function getDeliveriesTableData() {
  const table = document.getElementById('deliveriesTableMain');
  const headers = Array.from(table.querySelectorAll('thead th')).map(th => vn(th.innerText.trim()));
  const rows = Array.from(table.querySelectorAll('tbody tr')).map(tr =>
    Array.from(tr.querySelectorAll('td')).map(td => vn(td.innerText.trim()))
  );
  // Bỏ cột "Thao tác"
  const idx = headers.findIndex(h => h.toLowerCase().includes('thao tác'));
  if (idx > -1) {
    headers.splice(idx, 1);
    rows.forEach(r => r.splice(idx, 1));
  }
  return { headers, rows };
}

// ===== Export Excel/PDF =====
async function exportDeliveriesFile(type) {
  const { headers, rows } = getDeliveriesTableData();
  const fileName = `LoHangNhap_{{ now()->format('Y-m-d') }}`;

  // Excel
  if (type === 'excel') {
    const wb = XLSX.utils.book_new();
    const sheet = XLSX.utils.aoa_to_sheet([headers, ...rows]);
    XLSX.utils.book_append_sheet(wb, sheet, 'Deliveries');
    XLSX.writeFile(wb, `${fileName}.xlsx`);
    return;
  }

  // PDF
  if (type === 'pdf') {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF({ orientation: 'landscape', unit: 'pt', format: 'a4' });

    await loadCDNFont(doc);
    doc.setFont("SerifVN");
    doc.setCharSpace(0);
    doc.setLineHeightFactor(1.15);

    const tableHooks = {
      didParseCell: (data) => {
        data.cell.styles.font = 'SerifVN';
        data.cell.styles.fontStyle = 'normal';
        if (Array.isArray(data.cell.text)) data.cell.text = data.cell.text.map(vn);
        else if (typeof data.cell.text === 'string') data.cell.text = vn(data.cell.text);
      },
      willDrawCell: (data) => { data.doc.setCharSpace(0); }
    };

    // Tiêu đề
    doc.setFontSize(16);
    doc.text(vn("Danh sách lô hàng nhập"), 14, 18);

    doc.autoTable({
      startY: 24,
      styles:     { font: 'SerifVN', fontSize: 10 },
      headStyles: { font: 'SerifVN', fontSize: 10, fillColor: [59,130,246], textColor: [255,255,255] },
      bodyStyles: { font: 'SerifVN', fontSize: 10 },
      head: [headers],
      body: rows,
      theme: 'grid',
      ...tableHooks
    });

    doc.save(`${fileName}.pdf`);
  }
}

</script>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.querySelector("input[name='search']");
    const statusFilter = document.querySelector("select[name='status']");
    const supplierFilter = document.querySelector("select[name='supplier']");
    const reloadBtn = document.getElementById("reload-btn"); // nếu có nút reload
    const tableBody = document.getElementById("deliveryTable"); // tbody của bảng

    // --- Lọc dữ liệu khi thay đổi ---
    [statusFilter, supplierFilter].forEach(select => {
        if (select) {
            select.addEventListener("change", () => applyFilters());
        }
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
        params.set("search", searchInput?.value || '');
        params.set("status", statusFilter?.value || '');
        params.set("supplier", supplierFilter?.value || '');
        window.location.search = params.toString();
    }

    // --- AJAX reload ---
    if (reloadBtn) {
        reloadBtn.addEventListener("click", async function(e) {
            e.preventDefault();
            tableBody.innerHTML = `<tr><td colspan="10" class="text-center py-4">Đang tải dữ liệu...</td></tr>`;
            try {
                const response = await fetch(this.dataset.url, {
                    headers: { "X-Requested-With": "XMLHttpRequest" }
                });
                const data = await response.json();
                tableBody.innerHTML = data.html || `<tr><td colspan="10" class="text-center text-red-500">Không có dữ liệu.</td></tr>`;
            } catch (error) {
                tableBody.innerHTML = `<tr><td colspan="10" class="text-center text-red-500">Lỗi khi tải dữ liệu.</td></tr>`;
            }
        });
    }

    // --- Modal edit/delete ---
    window.openEdit = function(id) {
        const modal = document.getElementById('edit-modal-' + id);
        if (modal) modal.style.display = 'flex';
    }

    window.closeEdit = function(id) {
        const modal = document.getElementById('edit-modal-' + id);
        if (modal) modal.style.display = 'none';
    }

    window.openDelete = function(id) {
        const modal = document.getElementById('delete-modal-' + id);
        if (modal) modal.style.display = 'flex';
    }

    window.closeDelete = function(id) {
        const modal = document.getElementById('delete-modal-' + id);
        if (modal) modal.style.display = 'none';
    }
});
</script>

</div>
</html>
@endsection