@extends('admin.layout')
@section('title', 'Quản lý nhập hàng')
@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <header class="mb-8">
            <div class="flex justify-between items-center">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Quản Lý Hàng Nhập</h1>
                    <p class="text-gray-600">Theo dõi và quản lý các lô hàng nhập kho</p>
                </div>
                <button type="button" id="createProductBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Nhập sản phẩm mới
                </button>
            </div>
        </header>

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
                        <p class="text-2xl font-semibold text-gray-900">{{ number_format($totalValue, 0, ',', '.') }} ₫</p>
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

                                            <!-- Modal chỉnh sửa -->
                                            <div id="edit-modal-{{ $delivery->batch_id }}" style="display:none;"
                                                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-20">
                                                <div class="bg-white p-6 rounded-lg shadow-xl w-[500px]">
                                                    <h3 class="text-lg font-semibold mb-4">Cập nhật lô hàng: <span class="text-blue-600">{{ $delivery->batch_id }}</span></h3>

                                                    <form action="{{ route('admin.deliveries.update', $delivery->batch_id) }}" method="POST" class="space-y-4">
                                                        @csrf
                                                        @method('PUT')
                                                        
                                                        <!-- Nhà cung cấp -->
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 mb-1">Nhà cung cấp</label>
                                                            <select name="supplier_id" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                                                                @foreach ($suppliers as $supplier)
                                                                    <option value="{{ $supplier->supplier_id }}" {{ $delivery->supplier_id == $supplier->supplier_id ? 'selected' : '' }}>
                                                                        {{ $supplier->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <!-- Sản phẩm -->
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 mb-1">Sản phẩm</label>
                                                            <select name="product_id" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                                                                @foreach ($products as $product)
                                                                    <option value="{{ $product->product_id }}" {{ $delivery->product_id == $product->product_id ? 'selected' : '' }}>
                                                                        {{ $product->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <!-- Số lượng -->
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 mb-1">Số lượng</label>
                                                            <input type="number" name="quantity" value="{{ $delivery->quantity }}" min="1"
                                                                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                                                onchange="calculateEditTotal('{{ $delivery->batch_id }}')">
                                                        </div>

                                                        <!-- Giá -->
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 mb-1">Giá (₫)</label>
                                                            <input type="number" name="price" value="{{ $delivery->price }}" min="0"
                                                                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                                                onchange="calculateEditTotal('{{ $delivery->batch_id }}')">
                                                        </div>

                                                        <!-- Tổng giá trị -->
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 mb-1">Tổng giá trị</label>
                                                            <input type="text" id="total_value_{{ $delivery->batch_id }}" 
                                                                value="{{ number_format($delivery->total_value, 0, ',', '.') }} ₫" readonly
                                                                class="w-full bg-gray-50 border rounded-lg px-3 py-2">
                                                        </div>

                                                        <!-- Trạng thái -->
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 mb-1">Trạng thái</label>
                                                            <select name="status" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                                                                <option value="Chờ xử lý" {{ $delivery->status == 'Chờ xử lý' ? 'selected' : '' }}>Chờ xử lý</option>
                                                                <option value="Hoàn thành" {{ $delivery->status == 'Hoàn thành' ? 'selected' : '' }}>Hoàn thành</option>
                                                                <option value="Đã hủy" {{ $delivery->status == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                                                            </select>
                                                        </div>

                                                        <div class="flex justify-end gap-2 pt-4">
                                                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                                                                Cập nhật
                                                            </button>
                                                            <button type="button" onclick="closeEdit('{{ $delivery->batch_id }}')" 
                                                                class="px-4 py-2 rounded-lg border hover:bg-gray-100">
                                                                Hủy
                                                            </button>
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
// Modal thêm sản phẩm mới
const createModal = `
<div id="createDeliveryModal" style="display:none" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-20">
    <div class="bg-white p-6 rounded-lg shadow-xl w-[500px]">
        <h3 class="text-lg font-semibold mb-4">Nhập sản phẩm mới</h3>
        
        <form action="{{ route('admin.deliveries.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <!-- Nhà cung cấp -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nhà cung cấp</label>
                <select name="supplier_id" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">Chọn nhà cung cấp</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->supplier_id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>


            <!-- Tên sản phẩm -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tên sản phẩm <span class="text-red-500">*</span></label>
                <input type="text" name="product_name" required
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                    placeholder="Nhập tên sản phẩm mới">
            </div>

            <!-- Danh mục -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Danh mục <span class="text-red-500">*</span></label>
                <select name="category_id" required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">Chọn danh mục</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Giá bán -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Giá bán (₫) <span class="text-red-500">*</span></label>
                <input type="number" name="price" required min="0"
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                    placeholder="Nhập giá bán lẻ">
            </div>

            <!-- Số lượng nhập -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Số lượng nhập <span class="text-red-500">*</span></label>
                <input type="number" name="quantity" required min="1"
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                    onchange="calculateCreateTotal()">
            </div>

            <!-- Tổng giá trị -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tổng giá trị</label>
                <input type="text" id="create_total_value" readonly
                    class="w-full bg-gray-50 border rounded-lg px-3 py-2">
            </div>

            <div class="flex justify-end gap-2 pt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Tạo lô hàng
                </button>
                <button type="button" onclick="closeCreateModal()" 
                    class="px-4 py-2 rounded-lg border hover:bg-gray-100">
                    Hủy
                </button>
            </div>
        </form>
    </div>
</div>
`;

document.body.insertAdjacentHTML('beforeend', createModal);

document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.querySelector("input[name='search']");
    const statusFilter = document.querySelector("select[name='status']");
    const supplierFilter = document.querySelector("select[name='supplier']");
    const createProductBtn = document.getElementById("createProductBtn");
    const reloadBtn = document.getElementById("reload-btn");
    const tableBody = document.getElementById("deliveryTable");

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

    // --- Modal create/edit/delete ---
    window.openCreateModal = function() {
        const modal = document.getElementById('createProductModal');
        if (modal) modal.style.display = 'flex';
    }

    window.closeCreateModal = function() {
        const modal = document.getElementById('createProductModal');
        if (modal) modal.style.display = 'none';
    }

    // Tính tổng giá trị khi thay đổi số lượng hoặc giá
    document.querySelectorAll('#createProductForm input[name="quantity"], #createProductForm input[name="price"]')
        .forEach(input => {
            input.addEventListener('input', calculateTotal);
        });

    // Tính tổng giá trị cho form tạo mới
    window.calculateCreateTotal = function() {
        const form = document.querySelector('#createDeliveryModal form');
        const quantity = form.querySelector('input[name="quantity"]').value || 0;
        const price = form.querySelector('input[name="price"]').value || 0;
        const total = quantity * price;
        document.querySelector('#create_total_value').value = new Intl.NumberFormat('vi-VN').format(total) + ' ₫';
    }

    // Tính tổng giá trị cho form sửa
    window.calculateEditTotal = function(id) {
        const form = document.querySelector(`#edit-modal-${id} form`);
        const quantity = form.querySelector('input[name="quantity"]').value || 0;
        const price = form.querySelector('input[name="price"]').value || 0;
        const total = quantity * price;
        document.querySelector(`#total_value_${id}`).value = new Intl.NumberFormat('vi-VN').format(total) + ' ₫';
    }

    // Mở modal tạo mới
    window.openCreateModal = function() {
        const modal = document.getElementById('createDeliveryModal');
        if (modal) modal.style.display = 'flex';
    }

    // Đóng modal tạo mới
    window.closeCreateModal = function() {
        const modal = document.getElementById('createDeliveryModal');
        if (modal) modal.style.display = 'none';
    }

    // Mở modal sửa
    window.openEdit = function(id) {
        const modal = document.getElementById('edit-modal-' + id);
        if (modal) modal.style.display = 'flex';
    }

    // Click vào nút tạo mới
    if (createProductBtn) {
        createProductBtn.addEventListener('click', () => openCreateModal());
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