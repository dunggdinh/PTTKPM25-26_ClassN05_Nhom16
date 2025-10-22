@extends('admin.layout')
@section('title', 'Quản lý kho')
@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Main Content -->
            <!-- Page Title -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Quản Lý Kho</h1>
                <p class="text-gray-600 mt-2">Quản lý và theo dõi tình trạng tồn kho của tất cả sản phẩm.</p>
            </div>
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Tổng sản phẩm</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $totalProducts }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center">
                        <div class="bg-yellow-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Sắp hết hàng</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $lowStock }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center">
                        <div class="bg-red-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Hết hàng</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $outOfStock }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center">
                        <div class="bg-green-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Còn hàng</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $inStock }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alerts Section -->
            <div class="bg-white rounded-xl shadow-md mb-8">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900 flex items-center">
                        <svg class="w-6 h-6 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        Cảnh báo tồn kho
                    </h2>
                </div>
                <div class="p-6">
                    <div id="alertsList" class="space-y-2">
                        @foreach($outOfStockProducts as $product)
                            <div class="p-3 rounded-md bg-red-100 text-red-800 font-semibold">
                                {{ $product->name }} – Hết hàng
                            </div>
                        @endforeach

                        @foreach($lowStockProducts as $product)
                            <div class="p-3 rounded-md bg-yellow-100 text-yellow-800 font-semibold">
                                {{ $product->name }} – Sắp hết hàng ({{ $product->quantity }} sản phẩm còn lại)
                            </div>
                        @endforeach

                        @if($lowStockProducts->isEmpty() && $outOfStockProducts->isEmpty())
                            <div class="text-gray-500 text-sm">
                                Không có sản phẩm sắp hết hoặc hết hàng
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Inventory Table -->
            <div class="bg-white rounded-xl shadow-md">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Danh sách tồn kho</h2>
                    <!-- Filters and Search -->
                        <form method="GET" action="{{ route('admin.inventory') }}" 
                            class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">

                            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                                <div class="relative">
                                    <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." 
                                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent w-full md:w-64"
                                        value="{{ request('search') }}">
                                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>

                                <!-- Danh mục -->
                                <select name="category" 
                                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                    <option value="">Tất cả danh mục</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->category_id }}" 
                                            {{ request('category') == $category->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <!-- Trạng thái -->
                                <select name="status" 
                                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                    <option value="">Tất cả trạng thái</option>
                                    <option value="in-stock" {{ request('status') == 'in-stock' ? 'selected' : '' }}>Còn hàng</option>
                                    <option value="low-stock" {{ request('status') == 'low-stock' ? 'selected' : '' }}>Sắp hết</option>
                                    <option value="out-of-stock" {{ request('status') == 'out-of-stock' ? 'selected' : '' }}>Hết hàng</option>
                                </select>
                            </div>

                            <div class="flex space-x-3">
                                <button type="button" onclick="exportInventoryFile('excel')"
                                        class="bg-green-600 hover:bg-green-700 text-white border border-green-600 px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span>Xuất Excel</span>
                                </button>

                                <button type="button" onclick="exportInventoryFile('pdf')"
                                        class="bg-red-600 hover:bg-red-700 text-white border border-red-600 px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v8m0 0H8m4 0h4M6 4h12l-1 16H7L6 4z"></path>
                                    </svg>
                                    <span>Xuất PDF</span>
                                </button>


                                <a href="{{ route('admin.inventory') }}"
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
                <div class="overflow-x-auto">
                    <table id="inventoryTableMain" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã sản phẩm</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sản phẩm</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hãng</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Danh mục</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số lượng</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Giá</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bảo hành</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nhà cung cấp</th>
                            </tr>
                        </thead>

                        <tbody id="inventoryTable" class="bg-white divide-y divide-gray-200">
                            @forelse ($products as $product)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $product->product_id }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $product->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $product->brand }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $product->category->name ?? '—' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $product->quantity }}</td>

                                    <td class="px-6 py-4 text-sm">
                                        @if($product->quantity == 0)
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">Hết hàng</span>
                                        @elseif($product->quantity < 10)
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">Sắp hết</span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">Còn hàng</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-900">{{ number_format($product->price, 0, ',', '.') }}₫</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $product->warranty }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $product->supplier->name ?? '—' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="px-6 py-4 text-center text-gray-500 text-sm">Không có sản phẩm nào.</td>
                                </tr>
                            @endforelse
                        </tbody>


                    </table>
                    <div class="flex flex-col items-center mt-4 bg-white px-4 py-2 rounded-b-xl">
                        <div>
                            {{ $products->withQueryString()->links('pagination::simple-tailwind') }}
                        </div>
                        <div class="text-sm text-gray-500 mt-1">
                            Trang {{ $products->currentPage() }} / {{ $products->lastPage() }}
                        </div>
                    </div>


                </div>
            </div>
    </div>
    <!-- Export Excel Modal -->
    <div id="exportProductModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-xl max-w-3xl w-full">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="bg-green-100 p-2 rounded-lg">
                            <span class="text-xl">📦</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Xuất danh sách sản phẩm</h3>
                            <p class="text-sm text-gray-600">Tùy chỉnh dữ liệu trước khi xuất Excel</p>
                        </div>
                    </div>
                    <button onclick="closeProductExportModal()" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Chọn cột -->
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-3">Chọn cột xuất</h4>
                        <div class="border rounded-lg p-4 max-h-64 overflow-y-auto">
                            <div class="space-y-2">
                                <label class="flex items-center"><input type="checkbox" checked value="product_id" class="text-green-600"> <span class="ml-2 text-sm">Mã sản phẩm</span></label>
                                <label class="flex items-center"><input type="checkbox" checked value="name" class="text-green-600"> <span class="ml-2 text-sm">Tên sản phẩm</span></label>
                                <label class="flex items-center"><input type="checkbox" checked value="brand" class="text-green-600"> <span class="ml-2 text-sm">Hãng</span></label>
                                <label class="flex items-center"><input type="checkbox" checked value="category" class="text-green-600"> <span class="ml-2 text-sm">Danh mục</span></label>
                                <label class="flex items-center"><input type="checkbox" checked value="quantity" class="text-green-600"> <span class="ml-2 text-sm">Số lượng</span></label>
                                <label class="flex items-center"><input type="checkbox" checked value="status" class="text-green-600"> <span class="ml-2 text-sm">Trạng thái</span></label>
                                <label class="flex items-center"><input type="checkbox" checked value="price" class="text-green-600"> <span class="ml-2 text-sm">Giá</span></label>
                                <label class="flex items-center"><input type="checkbox" checked value="warranty" class="text-green-600"> <span class="ml-2 text-sm">Bảo hành</span></label>
                                <label class="flex items-center"><input type="checkbox" checked value="supplier" class="text-green-600"> <span class="ml-2 text-sm">Nhà cung cấp</span></label>
                            </div>
                        </div>
                        <div class="flex gap-2 mt-3">
                            <button onclick="selectAllProductCols()" class="text-sm text-blue-600 hover:underline">Chọn tất cả</button>
                            <button onclick="deselectAllProductCols()" class="text-sm text-gray-600 hover:underline">Bỏ chọn tất cả</button>
                        </div>
                    </div>

                    <!-- Định dạng file -->
                    <div>
                        <label for="productFileFormat" class="block text-sm font-medium text-gray-700 mb-1">Định dạng file</label>
                        <select id="productFileFormat" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-green-500">
                            <option value="xlsx">Excel (.xlsx)</option>
                            <option value="csv">CSV (.csv)</option>
                        </select>
                    </div>

                    <!-- Tên file -->
                    <div>
                        <label for="productFileName" class="block text-sm font-medium text-gray-700 mb-1">Tên file</label>
                        <input type="text" id="productFileName" value="danh-sach-san-pham" 
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-green-500">
                    </div>

                    <!-- Xem trước -->
                    <div class="bg-gray-50 rounded-lg p-4 text-sm text-gray-700" id="productPreview">
                        Sẽ xuất: <span class="font-medium">{{ $products->count() }}</span> sản phẩm<br>
                        Định dạng: <span class="font-medium">Excel (.xlsx)</span><br>
                        Cột: <span class="font-medium">9</span>
                    </div>
                </div>

                <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
                    <button onclick="closeProductExportModal()" class="px-6 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg">Hủy</button>
                    <button onclick="exportProductExcel()" class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg flex items-center gap-2">
                        <span>📊</span> Xuất Excel
                    </button>
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
function getInventoryTableData() {
  const table = document.getElementById('inventoryTableMain');
  const headers = Array.from(table.querySelectorAll('thead th')).map(th => vn(th.innerText.trim()));
  const rows = Array.from(table.querySelectorAll('tbody tr')).map(tr =>
    Array.from(tr.querySelectorAll('td')).map(td => vn(td.innerText.trim()))
  );
  return { headers, rows };
}

// ===== Export Excel/PDF =====
async function exportInventoryFile(type) {
  const { headers, rows } = getInventoryTableData();
  const fileName = `inventory-{{ now()->format('Y-m-d') }}`;

  if (type === 'excel') {
    const wb = XLSX.utils.book_new();
    const sheet = XLSX.utils.aoa_to_sheet([headers, ...rows]);
    XLSX.utils.book_append_sheet(wb, sheet, 'Inventory');
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
    doc.text(vn("Danh sách tồn kho"), 14, 18);

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
        const categoryFilter = document.querySelector("select[name='category']");
        const statusFilter = document.querySelector("select[name='status']");
        const reloadBtn = document.getElementById("reload-btn");
        const tableBody = document.getElementById("inventoryTable");

        // --- Lọc dữ liệu ---
        [categoryFilter, statusFilter].forEach(select => {
            select.addEventListener("change", () => applyFilters());
        });

        searchInput.addEventListener("keypress", function(e) {
            if (e.key === "Enter") {
                e.preventDefault();
                applyFilters();
            }
        });


        function applyFilters() {
            const params = new URLSearchParams(window.location.search);
            params.set("search", searchInput.value);
            params.set("category", categoryFilter.value);
            params.set("status", statusFilter.value);
            window.location.search = params.toString();
        }

        // --- Làm mới (AJAX) ---
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
    });
</script>

</div>
@endsection