@extends('admin.layout')
@section('title', 'Quản lý đơn hàng')
@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Quản Lý Đơn Hàng</h1>
                <p class="text-gray-600 mt-1">Theo dõi và xử lý đơn hàng của khách hàng</p>
            </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

            <!-- Tổng đơn hàng -->
            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Tổng Đơn Hàng</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalOrders }}</p>
                    </div>
                </div>
            </div>

            <!-- Chờ xử lý -->
            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Chờ Xử Lý</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $pendingOrders }}</p>
                    </div>
                </div>
            </div>

            <!-- Đã giao -->
            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Đã Giao</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $completedOrders }}</p>
                    </div>
                </div>
            </div>

            <!-- Doanh Thu -->
            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Doanh Thu</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($revenue,0,',','.') }} ₫</p>
                    </div>
                </div>
            </div>

        </div>
    

            <div class="bg-white rounded-xl shadow-md">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Danh sách đơn hàng</h2>
                    <!-- Filters and Search -->
                        <form method="GET" action="{{ route('admin.order') }}" 
                            class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">

                            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                                <div class="relative">
                                    <input type="text" name="search" placeholder="Tìm kiếm đơn hàng..." 
                                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent w-full md:w-64"
                                        value="{{ request('search') }}">
                                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>

                                <!-- Lọc trạng thái -->
                                <select name="status" id="status"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Tất cả trạng thái</option>
                                    <option value="Chờ xử lý" {{ request('status') == 'Chờ xử lý' ? 'selected' : '' }}>Chờ xử lý</option>
                                    <option value="Đang giao" {{ request('status') == 'Đang giao' ? 'selected' : '' }}>Đang giao</option>
                                    <option value="Đã giao" {{ request('status') == 'Đã giao' ? 'selected' : '' }}>Đã giao</option>
                                    <option value="Đã hủy" {{ request('status') == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                                </select>

                                <!-- Lọc theo thời gian -->
                                <select name="date" id="date"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Tất cả</option>
                                    <option value="today" {{ request('date') == 'today' ? 'selected' : '' }}>Hôm nay</option>
                                    <option value="week" {{ request('date') == 'week' ? 'selected' : '' }}>Tuần này</option>
                                    <option value="month" {{ request('date') == 'month' ? 'selected' : '' }}>Tháng này</option>
                                </select>
                            </div>

                            <div class="flex space-x-3">
                                <button type="button" onclick="exportOrderFile('excel')"
                                        class="bg-green-600 hover:bg-green-700 text-white border border-green-600 px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span>Xuất Excel</span>
                                </button>

                                <button type="button" onclick="exportOrderFile('pdf')"
                                        class="bg-red-600 hover:bg-red-700 text-white border border-red-600 px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v8m0 0H8m4 0h4M6 4h12l-1 16H7L6 4z"></path>
                                    </svg>
                                    <span>Xuất PDF</span>
                                </button>


                                <a href="{{ route('admin.order') }}"
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
        <!-- Orders Table -->          
            <table id="ordersTableMain" class="w-full border border-gray-200 rounded-lg">                
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã Đơn Hàng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Khách Hàng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sản Phẩm</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tổng Tiền</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng Thái</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Địa Chỉ</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày Đặt</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao Tác</th>
                        </tr>
                    </thead>

                    <tbody id="orderTable" class="bg-white divide-y divide-gray-200">
                        @forelse ($orders as $order)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $order->order_id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $order->user->name ?? 'Không xác định' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    @foreach ($order->orderItems as $item)
                                        <div>{{ $item->product->name ?? 'Sản phẩm không tồn tại' }} (x{{ $item->quantity }})</div>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ number_format($order->total_amount, 0, ',', '.') }} ₫</td>

                                <td class="px-6 py-4 text-sm">
                                    @php
                                        $status = trim($order->status);
                                        $statusColors = [
                                            'Chờ xử lý' => 'bg-yellow-100 text-yellow-800',
                                            'Đang xử lý' => 'bg-blue-100 text-blue-800',
                                            'Đang giao' => 'bg-purple-100 text-purple-800',
                                            'Hoàn tất' => 'bg-green-100 text-green-800',
                                            'Đã hủy' => 'bg-red-100 text-red-800',
                                        ];
                                    @endphp

                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ $status }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">{{ $order->shipping_address }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</td>
                                
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <div class="flex space-x-2">
                                        <!-- Nút Sửa -->
                                        <div>
                                            <button onclick="openEdit('{{ $order->order_id }}')" class="text-blue-600 hover:underline">Sửa</button>

                                            <!-- Modal chỉnh trạng thái -->
                                            <div id="edit-modal-{{ $order->order_id }}" style="display:none;"
                                                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-20">
                                                <div class="bg-white p-4 rounded shadow-md w-80">
                                                    <h3 class="font-semibold mb-2">Cập nhật trạng thái cho đơn: <span class="text-blue-600">{{ $order->order_id }}</span></h3>

                                                    <form action="{{ route('admin.order.updateStatus', $order->order_id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <select name="status" class="border rounded px-2 py-1 mb-4 w-full">
                                                            <option value="pending" {{ $order->status=='pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                                            <option value="processing" {{ $order->status=='processing' ? 'selected' : '' }}>Đang giao</option>
                                                            <option value="shipped" {{ $order->status=='shipped' ? 'selected' : '' }}>Đang vận chuyển</option>
                                                            <option value="delivered" {{ $order->status=='delivered' ? 'selected' : '' }}>Đã giao</option>
                                                            <option value="cancelled" {{ $order->status=='cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                                        </select>

                                                        <div class="flex justify-end gap-2">
                                                            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Cập nhật</button>
                                                            <button type="button" onclick="closeEdit('{{ $order->order_id }}')" class="px-3 py-1 rounded border hover:bg-gray-100">Hủy</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Nút Xóa -->
                                        <div>
                                            <button onclick="openDelete('{{ $order->order_id }}')" class="text-red-600 hover:underline">Xóa</button>

                                            <!-- Modal xác nhận xóa -->
                                            <div id="delete-modal-{{ $order->order_id }}" style="display:none;"
                                                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-20">
                                                <div class="bg-white p-4 rounded shadow-md w-80">
                                                    <h3 class="font-semibold mb-2">Xóa đơn: <span class="text-red-600">{{ $order->order_id }}</span></h3>
                                                    <p class="mb-4">Bạn có chắc muốn xóa đơn hàng này?</p>

                                                    <div class="flex justify-end gap-2">
                                                        <form action="{{ route('admin.order.destroy', $order->order_id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Xóa</button>
                                                        </form>
                                                        <button type="button" onclick="closeDelete('{{ $order->order_id }}')" class="px-3 py-1 rounded border hover:bg-gray-100">Hủy</button>
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
                            {{ $orders->withQueryString()->links('pagination::simple-tailwind') }}
                        </div>
                        <div class="text-sm text-gray-500 mt-1">
                            Trang {{ $orders->currentPage() }} / {{ $orders->lastPage() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </div>

<!-- SheetJS (Excel) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js" referrerpolicy="no-referrer"></script>

<!-- jsPDF + AutoTable (PDF) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.1/jspdf.plugin.autotable.min.js"></script>

<script>
// ===== Font Unicode từ CDN cho jsPDF (không cần file local) =====
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

// ===== Lấy dữ liệu từ bảng đang hiển thị =====
function getOrdersTableData() {
  const table = document.getElementById('ordersTableMain');

  // Lấy tất cả header rồi BỎ cột cuối (Thao Tác)
  let headers = Array.from(table.querySelectorAll('thead th'))
    .map(th => vn(th.innerText.trim()));
  headers = headers.slice(0, -1); // <-- bỏ cột cuối

  // Lấy từng dòng; với cột Sản phẩm (index 2) gộp các dòng <div>
  const rows = Array.from(table.querySelectorAll('tbody tr')).map(tr => {
    const tds = Array.from(tr.querySelectorAll('td'));

    // map tất cả cell
    const cells = tds.map((td, idx) => {
      // gộp nhiều sản phẩm thành 1 chuỗi
      if (idx === 2) {
        const text = td.innerText.split('\n').map(s => s.trim()).filter(Boolean).join('; ');
        return vn(text);
      }
      return vn(td.innerText.trim());
    });

    return cells.slice(0, -1); // <-- bỏ cột cuối (Thao Tác)
  });

  return { headers, rows };
}

// ===== Export Excel/PDF =====
async function exportOrderFile(type) {
  const { headers, rows } = getOrdersTableData();
  const fileName = `orders-{{ now()->format('Y-m-d') }}`;

  if (type === 'excel') {
    const wb = XLSX.utils.book_new();
    const sheet = XLSX.utils.aoa_to_sheet([headers, ...rows]);
    XLSX.utils.book_append_sheet(wb, sheet, 'Orders');
    XLSX.writeFile(wb, `${fileName}.xlsx`);
    return;
  }

  if (type === 'pdf') {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // 1) Nạp font + chỉnh spacing
    await loadCDNFont(doc);
    doc.setFont("SerifVN");
    doc.setCharSpace(0);
    doc.setLineHeightFactor(1.15);

    // 2) Hook: ép mọi cell dùng font + normalize
    const tableHooks = {
      didParseCell: (data) => {
        data.cell.styles.font = 'SerifVN';
        data.cell.styles.fontStyle = 'normal';
        if (Array.isArray(data.cell.text)) data.cell.text = data.cell.text.map(vn);
        else if (typeof data.cell.text === 'string') data.cell.text = vn(data.cell.text);
      },
      willDrawCell: (data) => { data.doc.setCharSpace(0); }
    };

    // 3) Render
    doc.setFontSize(16);
    doc.text(vn("Danh sách đơn hàng"), 14, 18);

    doc.autoTable({
      startY: 24,
      styles:     { font: 'SerifVN', fontSize: 10 },
      headStyles: { font: 'SerifVN', fontSize: 10, fillColor: [16,185,129], textColor: [255,255,255] },
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
    const dateFilter = document.querySelector("select[name='date']");
    const reloadBtn = document.getElementById("reload-btn"); // nếu có nút reload
    const tableBody = document.getElementById("orderTable");

    // --- Lọc dữ liệu khi thay đổi ---
    [statusFilter, dateFilter].forEach(select => {
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
        params.set("date", dateFilter?.value || '');
        window.location.search = params.toString();
    }

    // --- AJAX reload ---
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
    function openEdit(id) {
        document.getElementById('edit-modal-' + id).style.display = 'flex';
    }

    function closeEdit(id) {
        document.getElementById('edit-modal-' + id).style.display = 'none';
    }

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