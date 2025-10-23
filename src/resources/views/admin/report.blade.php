@extends('admin.layout')
@section('title', 'Thống kê')
@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Báo cáo & Thống kê</h1>
            <p class="text-gray-600">Tổng quan hiệu suất cửa hàng điện tử</p>
        </div>

        <!-- Action Buttons -->
        <div class="mb-8 flex flex-wrap gap-4">
            <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium transition-colors" onclick="exportReportFile('pdf')">
                📄 Xuất PDF
            </button>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Tổng doanh thu -->
            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center space-x-3">
                    <div class="w-14 h-14 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Tổng Doanh Thu</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($totalRevenue, 0, ',', '.') }} VNĐ</p>
                        <p class="text-green-600 text-xs mt-1">{{ $revenueDiff }} so với tháng trước</p>
                    </div>
                </div>
            </div>

            <!-- Đơn hàng -->
            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center space-x-3">
                    <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Đơn Hàng</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalOrders }}</p>
                        <p class="text-blue-600 text-xs mt-1">{{ $ordersDiff }} so với tuần trước</p>
                    </div>
                </div>
            </div>

            <!-- Khách hàng mới -->
            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center space-x-3">
                    <div class="w-14 h-14 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Khách Hàng Mới</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $newCustomers }}</p>
                        <p class="text-purple-600 text-xs mt-1">{{ $customersDiff }} so với tháng trước</p>
                    </div>
                </div>
            </div>

            <!-- Sản phẩm bán chạy -->
            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center space-x-3">
                    <div class="w-14 h-14 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Sản Phẩm Bán Chạy</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $topProducts->count() }}</p>
                        <p class="text-orange-600 text-xs mt-1">{{ $topProductsDiff }} so với tuần trước</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Revenue Chart -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Doanh Thu Theo Tháng</h3>
                    <select class="text-sm border border-gray-300 rounded-md px-3 py-1">
                        <option>2024</option>
                        <option>2023</option>
                    </select>
                </div>
                <div style="height: 300px;">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <!-- Orders Chart -->
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">📊 Phân tích đơn hàng</h3>
                    <select class="text-sm border border-gray-300 rounded-lg px-3 py-1" id="orderFilter" onchange="updateOrdersChart(this.value)">
                        <option value="month">Tháng này</option>
                        <option value="quarter">Quý này</option>
                        <option value="year" selected>Năm này</option>
                    </select>
                </div>
                <div class="relative h-72">
                    <canvas id="ordersChart"></canvas>
                </div>
            </div>
        </div>
        <!-- Tables Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Top Products -->
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">🏆 Sản phẩm bán chạy nhất</h3>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 text-sm font-medium text-gray-600">Sản phẩm</th>
                                <th class="text-right py-3 text-sm font-medium text-gray-600">Đã bán</th>
                                <th class="text-right py-3 text-sm font-medium text-gray-600">Doanh thu</th>
                            </tr>
                        </thead>
                        <tbody id="topProductsTable">
                            @foreach($topProducts as $product)
                                <tr class="border-b border-gray-100">
                                    <td class="py-3">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">📦</div>
                                            <div class="flex flex-col">
                                                <span class="text-sm font-medium">{{ $product->product->name ?? 'N/A' }}</span>
                                                <span class="text-xs text-gray-500">ID: {{ $product->product_id }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right py-3 text-sm font-medium">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $product->total_sold }} sp
                                        </span>
                                    </td>
                                    <td class="text-right py-3 text-sm font-medium text-green-600">
                                        {{ number_format($product->total_revenue, 0, ',', '.') }}₫
                                    </td>
                                </tr>
                            @endforeach
                            @if($topProducts->isEmpty())
                                <tr>
                                    <td colspan="3" class="py-3 text-center text-gray-500">Chưa có dữ liệu</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">🕒 Đơn hàng gần đây</h3>
                <div class="space-y-4" id="recentOrders">
                    @foreach($recentOrders as $order)
                        @php
                            $statusColors = [
                                'Hoàn tất' => 'green',
                                'Chờ xử lý' => 'blue',
                                'Đang xử lý' => 'orange',
                                'Đã hủy' => 'red'
                            ];
                            $paymentColors = [
                                'Đã thanh toán' => 'green',
                                'Chưa thanh toán' => 'yellow',
                                'Đang xử lý' => 'orange',
                                'Hủy thanh toán' => 'red'
                            ];
                            $color = $statusColors[$order->status] ?? 'gray';
                            $paymentColor = $paymentColors[$order->payment_status] ?? 'gray';
                        @endphp
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-{{ $color }}-500 rounded-full flex items-center justify-center text-white font-semibold">
                                    {{ strtoupper(substr($order->User->name ?? 'KH', 0, 2)) }}
                                </div>
                                <div>
                                    <div class="flex items-center space-x-2">
                                        <p class="text-sm font-medium">{{ $order->User->name ?? 'Khách hàng' }}</p>
                                        <p class="text-xs text-gray-500">#{{ $order->order_id }}</p>
                                    </div>
                                    <div class="flex items-center space-x-2 mt-1">
                                        <span class="inline-flex items-center px-2 py-0.5 text-xs bg-{{ $color }}-100 text-{{ $color }}-800 rounded-full">
                                            {{ $order->status }}
                                        </span>
                                        <span class="inline-flex items-center px-2 py-0.5 text-xs bg-{{ $paymentColor }}-100 text-{{ $paymentColor }}-800 rounded-full">
                                            {{ $order->payment_status }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900">{{ number_format($order->total_amount, 0, ',', '.') }}₫</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $order->created_at ? \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') : 'N/A' }}</p>
                            </div>
                        </div>
                    @endforeach
                    @if($recentOrders->isEmpty())
                        <p class="text-gray-500 text-center">Chưa có đơn hàng gần đây</p>
                    @endif
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
// ===== Font Unicode từ CDN (không cần .ttf local) =====
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

// ===== Chuẩn hoá Unicode (tránh lỗi dấu) =====
function vn(t) {
  if (t === null || t === undefined) return '';
  try { t = t.toString().normalize('NFC'); } catch {}
  return t.replace(/\u00A0/g, ' ');
}

// ===== Lấy dữ liệu từ UI (Top sản phẩm + Đơn gần đây) =====
function getReportTables() {
  // Top sản phẩm
  const topTable = document.getElementById('topProductsTable');
  const topRows = Array.from(topTable.querySelectorAll('tr'))
    .map(tr => Array.from(tr.querySelectorAll('td')).map(td => vn(td.innerText.trim())))
    .filter(r => r.length > 0); // [Sản phẩm, Đã bán, Doanh thu]

  // Đơn hàng gần đây
  const orderContainer = document.getElementById('recentOrders');
  const orderItems = Array.from(orderContainer.querySelectorAll('.flex.items-center.justify-between'))
    .map(div => {
      const name = vn(div.querySelector('p.text-sm')?.innerText || '');
      const id = vn(div.querySelector('p.text-xs')?.innerText || '');
      const total = vn(div.querySelector('.text-sm.font-medium')?.innerText || '');
      const status = vn(div.querySelector('span.rounded-full')?.innerText || '');
      return [name, id, total, status]; // [Khách, Mã đơn, Tổng tiền, Trạng thái]
    });

  return { topRows, orderItems };
}

// ===== HÀM GỘP: Xuất Excel hoặc PDF theo type =====
async function exportReportFile(type) {
  const { topRows, orderItems } = getReportTables();
  const fileName = `BaoCao_ThongKe_{{ now()->format('Y-m-d') }}`;

  if (type === 'excel') {
    // ---- Excel ----
    const wb = XLSX.utils.book_new();

    const topHeader = ['Sản phẩm', 'Đã bán', 'Doanh thu'];
    const sheet1 = XLSX.utils.aoa_to_sheet([topHeader, ...topRows]);
    XLSX.utils.book_append_sheet(wb, sheet1, 'TopSanPham');

    const orderHeader = ['Khách hàng', 'Mã đơn', 'Tổng tiền', 'Trạng thái'];
    const sheet2 = XLSX.utils.aoa_to_sheet([orderHeader, ...orderItems]);
    XLSX.utils.book_append_sheet(wb, sheet2, 'DonHangGanDay');

    XLSX.writeFile(wb, `${fileName}.xlsx`);
    return;
  }

  if (type === 'pdf') {
    // ---- PDF ----
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF({ orientation: 'portrait', unit: 'pt', format: 'a4' });

    await loadCDNFont(doc);
    doc.setFont("SerifVN");
    if (doc.setCharSpace) doc.setCharSpace(0);
    doc.setLineHeightFactor(1.15);

    const tableHooks = {
      didParseCell: (data) => {
        data.cell.styles.font = 'SerifVN';
        data.cell.styles.fontStyle = 'normal';
        if (Array.isArray(data.cell.text)) data.cell.text = data.cell.text.map(vn);
        else if (typeof data.cell.text === 'string') data.cell.text = vn(data.cell.text);
      },
      willDrawCell: (data) => { if (data.doc.setCharSpace) data.doc.setCharSpace(0); }
    };

    // Header
    doc.setFontSize(18);
    doc.text(vn("BÁO CÁO & THỐNG KÊ CỬA HÀNG ĐIỆN TỬ"), 40, 40);
    doc.setFontSize(11);
    doc.text(vn("Xuất lúc: ") + new Date().toLocaleString('vi-VN'), 40, 60);

    // Bảng 1: Top sản phẩm
    doc.setFontSize(13);
    doc.text(vn("🏆 Top sản phẩm bán chạy nhất"), 40, 90);
    doc.autoTable({
      startY: 100,
      styles:     { font: 'SerifVN', fontSize: 10 },
      headStyles: { font: 'SerifVN', fillColor: [59,130,246], textColor: 255 },
      head: [['Sản phẩm', 'Đã bán', 'Doanh thu']],
      body: topRows,
      theme: 'grid',
      ...tableHooks
    });

    // Bảng 2: Đơn hàng gần đây
    let y = doc.lastAutoTable ? doc.lastAutoTable.finalY + 40 : 140;
    doc.setFontSize(13);
    doc.text(vn("🕒 Đơn hàng gần đây"), 40, y);
    doc.autoTable({
      startY: y + 10,
      styles:     { font: 'SerifVN', fontSize: 10 },
      headStyles: { font: 'SerifVN', fillColor: [16,185,129], textColor: 255 },
      head: [['Khách hàng', 'Mã đơn', 'Tổng tiền', 'Trạng thái']],
      body: orderItems,
      theme: 'grid',
      ...tableHooks
    });

    doc.save(`${fileName}.pdf`);
    return;
  }

  console.warn('exportReportFile: type không hợp lệ. Dùng "excel" hoặc "pdf".');
}
</script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const revenueData = @json($monthlyRevenue);
const orderData = @json($orderAnalysis);

// Biểu đồ doanh thu
// VẼ CHART (giữ nguyên phần của bạn)
        const ctx = document.getElementById('revenueChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach(range(1,12) as $m)
                        "{{ $m }}",
                    @endforeach
                ],
                datasets: [{
                    label: 'Doanh thu (VNĐ)',
                    data: [
                        @foreach(range(1,12) as $m)
                            {{ $monthlyRevenue[$m] ?? 0 }},
                        @endforeach
                    ],
                    borderWidth: 1,
                    backgroundColor: '#3B82F6'
                }]
            },
            options: { scales: { y: { beginAtZero: true } } }
        });


// Remove the old chart code as we're using a grid layout now

// Biểu đồ phân tích đơn hàng
const orderChartData = @json($orderChartData);
new Chart(document.getElementById('ordersChart'), {
    type: 'doughnut',
    data: {
        labels: Object.keys(orderChartData),
        datasets: [{
            label: 'Đơn hàng',
            data: Object.values(orderChartData),
            backgroundColor: [
                'rgba(34,197,94,0.7)',   // Hoàn tất
                'rgba(251,191,36,0.7)',   // Đang xử lý
                'rgba(59,130,246,0.7)',   // Chờ xử lý
                'rgba(239,68,68,0.7)'     // Đã hủy
            ],
            borderWidth: 1
        }]
    },
    options: { 
        responsive: true, 
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'right',
                labels: {
                    font: {
                        size: 12
                    }
                }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                        const value = context.raw;
                        const percentage = ((value / total) * 100).toFixed(1);
                        return `${context.label}: ${value} (${percentage}%)`;
                    }
                }
            }
        }
    }
});


// Placeholder functions for dynamic filter (optional)
function updateRevenueChart(value) {
    // Gửi request AJAX hoặc lọc dữ liệu trên client nếu đã có sẵn
    console.log('Lọc doanh thu:', value);
}

function updateOrdersChart(value) {
    console.log('Lọc đơn hàng:', value);
}
</script>
</div>
</html>
@endsection