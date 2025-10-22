@extends('admin.layout')
@section('title', 'Dashboard')
@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100">
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Dashboard Title -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Dashboard Admin</h1>
                <p class="text-gray-600">Tổng quan quản lý cửa hàng điện tử</p>
            </div>

            <div class="flex items-center gap-3">
                <button onclick="exportDashboardFile('excel')" 
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium">
                    📊 Xuất Excel
                </button>

                <button onclick="exportDashboardFile('pdf')" 
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium">
                    🧾 Xuất PDF
                </button>
            </div>
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
                        <p class="text-2xl font-bold text-gray-900">
                            {{ number_format($totalRevenue, 0, ',', '.') }} VNĐ
                        </p>
                    </div>
                </div>
            </div>

            <!-- Đơn hàng -->
            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Đơn Hàng</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalOrders }}</p>
                        <p class="text-blue-600 text-sm">+8.2% so với tuần trước</p>
                    </div>
                </div>
            </div>

            <!-- Khách hàng -->
            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Khách Hàng</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalCustomers }}</p>
                        <p class="text-purple-600 text-sm">+156 khách hàng mới</p>
                    </div>
                </div>
            </div>

            <!-- Sản phẩm -->
            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Sản Phẩm</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalProducts }}</p>
                        <p class="text-orange-600 text-sm">{{ $lowStockProducts }} sản phẩm sắp hết</p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Charts and Tables Row -->
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

            <!-- Top Products -->
            <div class="space-y-4">
                @foreach($topProducts as $product)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                            <span class="text-white text-sm">📦</span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">{{ $product->product->name ?? 'Không xác định' }}</p>
                            <p class="text-sm text-gray-600">{{ $product->total_sold }} đã bán</p>
                        </div>
                    </div>
                    <span class="text-green-600 font-semibold">+{{ rand(5,20) }}%</span>
                </div>
                @endforeach
            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- SheetJS for Excel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <!-- jsPDF for PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.1/jspdf.plugin.autotable.min.js"></script>
    <script>
    // Dùng font mặc định cho toàn bộ autotable (head/body/foot/column)
    function applyAutoTableDefaults() {
        if (window.jspdf && window.jspdf.autoTableSetDefaults) {
            window.jspdf.autoTableSetDefaults({
            styles:     { font: 'SerifVN', fontSize: 11 },
            headStyles: { font: 'SerifVN', fontStyle: 'normal' },
            bodyStyles: { font: 'SerifVN', fontStyle: 'normal' },
            footStyles: { font: 'SerifVN', fontStyle: 'normal' },
            columnStyles: {} // có thể set từng cột sau
            });
        }
    }

    // Chuẩn hoá Unicode về NFC để không bị tách dấu
    function vn(text) {
        if (text === null || text === undefined) return '';
        try { return text.toString().normalize('NFC'); }
        catch { return text.toString(); }
    }
    </script>

    <script>
    // Nạp 1 font serif có hỗ trợ tiếng Việt từ CDN và đăng ký vào jsPDF
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
            base64 = btoa(bin);
            break;
            } catch (e) {}
        }
        if (!base64) return alert("Không tải được font từ CDN. PDF có thể lỗi tiếng Việt.");

        doc.addFileToVFS(postName + ".ttf", base64);
        doc.addFont(postName + ".ttf", postName, "normal");
        doc.setFont(postName); // dùng font này cho toàn bộ PDF
    }
    </script>

    <script>
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
    </script>

    <script>
    /**
     * Xuất toàn bộ dữ liệu Dashboard ra 1 file Excel với 3 sheets:
     * - KPIs
     * - Revenue_{{ now()->year ?? 'Year' }}
     * - TopProducts
     */
    async function exportDashboardFile(type) {
        const totalRevenue   = @json($totalRevenue ?? 0);
        const totalOrders    = @json($totalOrders ?? 0);
        const totalCustomers = @json($totalCustomers ?? 0);
        const totalProducts  = @json($totalProducts ?? 0);
        const lowStock       = @json($lowStockProducts ?? 0);
        const monthlyRevenue = @json($monthlyRevenue ?? []);
        const topProductsPHP = @json(
            collect($topProducts ?? [])->map(function($p){
                return [
                    'product_name' => optional($p->product)->name,
                    'total_sold'   => $p->total_sold ?? 0,
                ];
            })
        );

        const kpiRows = [
            ['Chỉ số', 'Giá trị', 'Ghi chú'],
            ['Tổng Doanh Thu', totalRevenue, 'VNĐ'],
            ['Tổng Đơn Hàng', totalOrders, ''],
            ['Tổng Khách Hàng', totalCustomers, ''],
            ['Tổng Sản Phẩm', totalProducts, ''],
            ['SP sắp hết hàng', lowStock, '']
        ];

        const revenueRows = Object.keys(monthlyRevenue).map(m => [m, monthlyRevenue[m]]);
        const topProductsRows = (topProductsPHP || []).map(p => [p.product_name ?? '-', p.total_sold ?? 0]);

        const fileName = `dashboard-{{ now()->format('Y-m-d') }}`;

        if (type === 'excel') {
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, XLSX.utils.aoa_to_sheet(kpiRows), 'KPIs');
            XLSX.utils.book_append_sheet(wb, XLSX.utils.aoa_to_sheet([['Tháng','Doanh Thu'], ...revenueRows]), 'Revenue');
            XLSX.utils.book_append_sheet(wb, XLSX.utils.aoa_to_sheet([['Sản phẩm','Đã bán'], ...topProductsRows]), 'TopProducts');
            XLSX.writeFile(wb, `${fileName}.xlsx`);
        }
        else if (type === 'pdf') {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            // 1) Nạp font Unicode từ CDN và set font
            await loadCDNFont(doc);        // đăng ký font "SerifVN"
            doc.setFont("SerifVN");
            doc.setCharSpace(0);           // ✨ quan trọng: bỏ giãn ký tự
            doc.setLineHeightFactor(1.15); // line-height cân đẹp hơn

            // 2) Helpers: normalize NFC + fix NBSP
            const vn = (t) => {
                if (t === null || t === undefined) return '';
                try { t = t.toString().normalize('NFC'); } catch {}
                return t.replace(/\u00A0/g, ' '); // bỏ NBSP nếu có
            };
            const map2D = (rows) => rows.map(r => r.map(vn));

            // 3) Chuẩn hoá dữ liệu đầu vào
            const kpiHead = ['Chỉ số','Giá trị','Ghi chú'].map(vn);
            const kpiBody = map2D(kpiRows.slice(1));
            const revHead = ['Tháng','Doanh Thu (VNĐ)'].map(vn);
            const revBody = revenueRows.map(r => [vn(r[0]), r[1]]);
            const topHead = ['Tên sản phẩm','Đã bán'].map(vn);
            const topBody = topProductsRows.map(r => [vn(r[0]), r[1]]);

            // 4) Hooks cho autotable: set font + charSpace = 0 cho MỌI cell
            const tableHooks = {
                didParseCell: (data) => {
                data.cell.styles.font = 'SerifVN';
                data.cell.styles.fontStyle = 'normal';
                // normalize mọi text
                if (Array.isArray(data.cell.text)) {
                    data.cell.text = data.cell.text.map(vn);
                } else if (typeof data.cell.text === 'string') {
                    data.cell.text = vn(data.cell.text);
                }
                },
                willDrawCell: (data) => {
                    // ép charSpace = 0 trước khi vẽ
                    data.doc.setCharSpace(0);
                }
            };

            // 5) Render
            doc.setFontSize(18);
            doc.text(vn("Dashboard Report"), 14, 20);

            doc.setFontSize(14);
            doc.text(vn("1) KPIs"), 14, 35);
            doc.autoTable({
                startY: 38,
                styles:     { font: 'SerifVN', fontSize: 11, textColor: [0,0,0] },
                headStyles: { font: 'SerifVN', fillColor: [16,185,129], textColor: [255,255,255] },
                bodyStyles: { font: 'SerifVN' },
                head: [kpiHead],
                body: kpiBody,
                theme: 'grid',
                ...tableHooks
            });

            let finalY = doc.lastAutoTable.finalY + 10;
            doc.text(vn("2) Doanh Thu Theo Tháng"), 14, finalY);
            doc.autoTable({
                startY: finalY + 3,
                styles:     { font: 'SerifVN', fontSize: 11 },
                headStyles: { font: 'SerifVN', fillColor: [0,102,204], textColor: [255,255,255] },
                bodyStyles: { font: 'SerifVN' },
                head: [revHead],
                body: revBody,
                theme: 'striped',
                ...tableHooks
            });

            finalY = doc.lastAutoTable.finalY + 10;
            doc.text(vn("3) Sản Phẩm Bán Chạy"), 14, finalY);
            doc.autoTable({
                startY: finalY + 3,
                styles:     { font: 'SerifVN', fontSize: 11 },
                headStyles: { font: 'SerifVN', fillColor: [16,185,129], textColor: [255,255,255] },
                bodyStyles: { font: 'SerifVN' },
                head: [topHead],
                body: topBody,
                theme: 'grid',
                ...tableHooks
            });

            doc.save(`${fileName}.pdf`);
        }

    }

    </script>


</div>
</html>
@endsection