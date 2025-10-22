@extends('admin.layout')
@section('title', 'Quản Lý Khuyến Mãi')

@section('content')
<main class="container mx-auto px-6 py-8">
    <!-- Header -->
    <header class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Quản Lý Khuyến Mãi</h1>
                <p class="text-gray-600 mt-2">Tạo và quản lý các chương trình khuyến mãi cho cửa hàng</p>
            </div>
            <button type="button" id="createPromoBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tạo Khuyến Mãi Mới
            </button>
        </div>
    </header>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Tổng Khuyến Mãi</p>
                    <p class="text-2xl font-bold text-gray-900">24</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Đang Hoạt Động</p>
                    <p class="text-2xl font-bold text-green-600">8</p>
                </div>
                <div class="bg-green-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Sắp Hết Hạn</p>
                    <p class="text-2xl font-bold text-orange-600">3</p>
                </div>
                <div class="bg-orange-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Đã Kết Thúc</p>
                    <p class="text-2xl font-bold text-gray-600">13</p>
                </div>
                <div class="bg-gray-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 mb-6">
        <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
            <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Tìm kiếm khuyến mãi..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full md:w-80">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <select id="statusFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Tất cả trạng thái</option>
                    <option value="active">Đang hoạt động</option>
                    <option value="scheduled">Đã lên lịch</option>
                    <option value="expired">Đã hết hạn</option>
                    <option value="paused">Tạm dừng</option>
                </select>
                <select id="typeFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Tất cả loại</option>
                    <option value="percentage">Giảm theo %</option>
                    <option value="fixed">Giảm cố định</option>
                    <option value="shipping">Miễn phí ship</option>
                    <option value="bundle">Mua kèm</option>
                </select>
            </div>
            <div class="flex items-center gap-3">
                <button id="exportPdfBtn" type="button"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v8m0 0H8m4 0h4M6 4h12l-1 16H7L6 4z"/>
                    </svg>
                    Xuất PDF
                </button>
            </div>
        </div>
    </div>

    <!-- Promotions Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table id="promotionsTableMain" class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Khuyến Mãi</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Loại</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Giá Trị</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thời Gian</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng Thái</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Đã Sử Dụng</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao Tác</th>
                    </tr>
                </thead>
                <tbody id="promotionsTable" class="bg-white divide-y divide-gray-200">
                    <!-- Render bằng JS -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="flex items-center justify-between mt-6">
        <div class="text-sm text-gray-700">
            Hiển thị <span class="font-medium">1</span> đến <span class="font-medium">10</span> của <span class="font-medium">24</span> kết quả
        </div>
        <div class="flex items-center space-x-2">
            <button class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Trước</button>
            <button class="px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md">1</button>
            <button class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">2</button>
            <button class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">3</button>
            <button class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Sau</button>
        </div>
    </div>
</main>

<!-- Create/Edit Promotion Modal -->
<div id="promotionModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full max-h-full overflow-y-auto">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 id="modalTitle" class="text-xl font-semibold text-gray-900">Tạo Khuyến Mãi Mới</h2>
                <button id="closeModal" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <form id="promotionForm" class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="promoName" class="block text-sm font-medium text-gray-700 mb-2">Tên Khuyến Mãi</label>
                    <input type="text" id="promoName" name="promoName" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="VD: Giảm giá mùa hè">
                </div>
                <div>
                    <label for="promoCode" class="block text-sm font-medium text-gray-700 mb-2">Mã Khuyến Mãi</label>
                    <input type="text" id="promoCode" name="promoCode" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="VD: SUMMER2024">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="discountType" class="block text-sm font-medium text-gray-700 mb-2">Loại Giảm Giá</label>
                    <select id="discountType" name="discountType" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="percentage">Giảm theo phần trăm (%)</option>
                        <option value="fixed">Giảm số tiền cố định (VNĐ)</option>
                        <option value="shipping">Miễn phí vận chuyển</option>
                        <option value="bundle">Mua kèm giảm giá</option>
                    </select>
                </div>
                <div>
                    <label for="discountValue" class="block text-sm font-medium text-gray-700 mb-2">Giá Trị Giảm</label>
                    <input type="number" id="discountValue" name="discountValue" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="VD: 20">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="startDate" class="block text-sm font-medium text-gray-700 mb-2">Ngày Bắt Đầu</label>
                    <input type="datetime-local" id="startDate" name="startDate" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label for="endDate" class="block text-sm font-medium text-gray-700 mb-2">Ngày Kết Thúc</label>
                    <input type="datetime-local" id="endDate" name="endDate" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="usageLimit" class="block text-sm font-medium text-gray-700 mb-2">Giới Hạn Sử Dụng</label>
                    <input type="number" id="usageLimit" name="usageLimit" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="VD: 100">
                </div>
                <div>
                    <label for="minOrderValue" class="block text-sm font-medium text-gray-700 mb-2">Giá Trị Đơn Hàng Tối Thiểu</label>
                    <input type="number" id="minOrderValue" name="minOrderValue" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="VD: 500000">
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Mô Tả</label>
                <textarea id="description" name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Mô tả chi tiết về chương trình khuyến mãi..."></textarea>
            </div>

            <div class="flex items-center space-x-4">
                <label class="flex items-center">
                    <input type="checkbox" id="isActive" name="isActive" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-700">Kích hoạt ngay</span>
                </label>
                <label class="flex items-center">
                    <input type="checkbox" id="isPublic" name="isPublic" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-700">Hiển thị công khai</span>
                </label>
            </div>

            <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                <button type="button" id="cancelBtn" class="px-6 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition-colors duration-200">Hủy</button>
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors duration-200">Lưu Khuyến Mãi</button>
            </div>
        </form>
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

// ===== Lấy dữ liệu từ bảng đang HIỂN THỊ (DOM) =====
// BỎ cột cuối "Thao Tác" khỏi export
function getPromotionsTableDOM() {
  const table = document.getElementById('promotionsTableMain');
  let headers = Array.from(table.querySelectorAll('thead th')).map(th => vn(th.innerText.trim()));
  headers = headers.slice(0, -1); // bỏ cột "Thao Tác"

  const rows = Array.from(table.querySelectorAll('tbody tr')).map(tr => {
    const tds = Array.from(tr.querySelectorAll('td')).map(td => vn(td.innerText.trim()));
    return tds.slice(0, -1); // bỏ cột "Thao Tác"
  });
  return { headers, rows };
}

// ===== HOẶC: Lấy dữ liệu từ STATE (promotions) để export toàn bộ (bỏ phân trang) =====
function buildTableFromState(list) {
  const headers = ['Khuyến Mãi','Loại','Giá Trị','Thời Gian','Trạng Thái','Đã Sử Dụng'].map(vn);
  const rows = (list || []).map(p => {
    const code  = vn(p.code ?? '');
    const type  = vn(({percentage:'Giảm %', fixed:'Giảm cố định', shipping:'Miễn phí ship', bundle:'Mua kèm'})[p.type] || p.type || '');
    const val   = p.type==='percentage'
                  ? `${Number(p.value||0)}%`
                  : (p.type==='fixed' ? `${Number(p.value||0).toLocaleString('vi-VN')}đ` : (p.type==='shipping'?'Miễn phí': `${Number(p.value||0)}`));
    const time  = vn(`${p.start_date||''} - ${p.end_date||''}`);
    const st    = vn(({active:'Đang hoạt động', scheduled:'Đã lên lịch', expired:'Đã hết hạn', paused:'Tạm dừng'})[p.status] || p.status || '');
    const used  = '—';
    return [code, type, val, time, st, used];
  });
  return { headers, rows };
}

// ===== Export Excel/PDF =====
// mode = 'dom' (xuất theo trang đang hiển thị) hoặc 'state' (xuất toàn bộ từ state promotions)
async function exportPromotions(type, mode='dom') {
  const fileName = `promotions-{{ now()->format('Y-m-d') }}`;
  const { headers, rows } = (mode === 'state') ? buildTableFromState(window.promotions) : getPromotionsTableDOM();

  if (type === 'excel') {
    const wb = XLSX.utils.book_new();
    const sheet = XLSX.utils.aoa_to_sheet([headers, ...rows]);
    XLSX.utils.book_append_sheet(wb, sheet, 'Promotions');
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
    doc.text(vn("Danh sách khuyến mãi"), 14, 18);

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
/** ====== STATE ====== */
let promotions = []; // giữ danh sách lấy từ server

/** ====== Fetch dữ liệu từ Controller ====== */
async function loadPromotions() {
    try {
        const res = await fetch('{{ route('admin.promotions.list') }}', {
            headers: { 'Accept': 'application/json' }
        });
        const data = await res.json();
        // data: [{discount_id, code, type, value, status, start_date, end_date}, ...]
        promotions = Array.isArray(data) ? data : [];
        renderPromotions(); // dùng state
    } catch (e) {
        console.error(e);
        showNotification('Không tải được danh sách khuyến mãi!', 'error');
    }
}

/** ====== DOM ====== */
const createPromoBtn   = document.getElementById('createPromoBtn');
const promotionModal   = document.getElementById('promotionModal');
const closeModal       = document.getElementById('closeModal');
const cancelBtn        = document.getElementById('cancelBtn');
const promotionForm    = document.getElementById('promotionForm');
const promotionsTable  = document.getElementById('promotionsTable');
const searchInput      = document.getElementById('searchInput');
const statusFilter     = document.getElementById('statusFilter');
const typeFilter       = document.getElementById('typeFilter');
const exportExcelBtn   = document.getElementById('exportExcelBtn');
const exportPdfBtn     = document.getElementById('exportPdfBtn');

/** ====== UTILS ====== */
function getStatusBadge(status){
    const map = {
        active   : { class: 'bg-green-100 text-green-800',  text:'Đang hoạt động' },
        scheduled: { class: 'bg-blue-100 text-blue-800',   text:'Đã lên lịch' },
        expired  : { class: 'bg-red-100 text-red-800',     text:'Đã hết hạn' },
        paused   : { class: 'bg-yellow-100 text-yellow-800',text:'Tạm dừng' }
    };
    const c = map[status] || map.paused;
    return `<span class="px-2 py-1 text-xs font-medium rounded-full ${c.class}">${c.text}</span>`;
}
function getTypeText(type){
    const types = { percentage:'Giảm %', fixed:'Giảm cố định', shipping:'Miễn phí ship', bundle:'Mua kèm' };
    return types[type] || type;
}
function formatValue(type, value){
    if (type === 'percentage') return `${Number(value || 0)}%`;
    if (type === 'fixed')      return `${Number(value || 0).toLocaleString('vi-VN')}đ`;
    if (type === 'shipping')   return 'Miễn phí';
    return `${Number(value || 0)}`;
}
function formatDate(dateString){
    if (!dateString) return '';
    // dateString từ DB có thể là "2025-10-22 10:00:00"
    return new Date(dateString.replace(' ', 'T')).toLocaleDateString('vi-VN');
}

/** ====== RENDER ====== */
// Lưu ý: dùng đúng field từ API: code, type, value, status, start_date, end_date, discount_id
function renderPromotions(data) {
    const list = Array.isArray(data) ? data : promotions;
    if (!promotionsTable) return;

    promotionsTable.innerHTML = list.map(promo => {
        const code       = promo.code ?? '';
        const type       = promo.type ?? '';
        const value      = promo.value ?? 0;
        const status     = promo.status ?? '';
        const start_date = promo.start_date ?? '';
        const end_date   = promo.end_date ?? '';
        const pk         = promo.discount_id ?? ''; // primary key

        return `
        <tr class="hover:bg-gray-50 transition-colors duration-150">
            <td class="px-6 py-4">
                <div>
                    <div class="text-sm font-medium text-gray-900">${code}</div>
                    <div class="text-xs text-gray-500">Mã KM</div>
                </div>
            </td>
            <td class="px-6 py-4 text-sm text-gray-900">${getTypeText(type)}</td>
            <td class="px-6 py-4 text-sm font-medium text-gray-900">${formatValue(type, value)}</td>
            <td class="px-6 py-4 text-sm text-gray-500">
                <div>${formatDate(start_date)} - ${formatDate(end_date)}</div>
            </td>
            <td class="px-6 py-4">${getStatusBadge(status)}</td>
            <td class="px-6 py-4 text-sm text-gray-900">
                <span class="text-gray-500 italic">—</span>
            </td>
            <td class="px-6 py-4 text-sm font-medium">
                <div class="flex space-x-2">
                    <button onclick="editPromotion('${pk}')" class="text-blue-600 hover:text-blue-900 transition-colors">Sửa</button>
                    <button onclick="togglePromotion('${pk}')" class="text-green-600 hover:text-green-900 transition-colors">
                        ${status === 'active' ? 'Tạm dừng' : 'Kích hoạt'}
                    </button>
                    <button onclick="deletePromotion('${pk}')" class="text-red-600 hover:text-red-900 transition-colors">Xóa</button>
                </div>
            </td>
        </tr>`;
    }).join('');
}

/** ====== MODAL ====== */
function openModal(title='Tạo Khuyến Mãi Mới'){
    document.getElementById('modalTitle').textContent = title;
    promotionModal.classList.remove('hidden');
    promotionModal.classList.add('flex');
    const card = promotionModal.querySelector('.bg-white');
    if (card) card.classList.add('slide-down');
}
function closeModalFunc(){
    promotionModal.classList.add('hidden');
    promotionModal.classList.remove('flex');
    promotionForm.reset();
}

/** ====== ACTIONS (UI demo) ====== */
// Nếu bạn đã có API PUT/DELETE/toggle, thay các hàm này bằng fetch() tới route tương ứng.

window.editPromotion = function(pk){
    const promo = promotions.find(p => (p.discount_id ?? '') === pk);
    if (!promo) return;
    openModal('Chỉnh Sửa Khuyến Mãi');
    // map lên form
    document.getElementById('promoName').value      = promo.code || ''; // tạm coi "Tên KM" = code (DB chưa có cột name)
    document.getElementById('promoCode').value      = promo.code || '';
    document.getElementById('discountType').value   = promo.type || '';
    document.getElementById('discountValue').value  = promo.value || 0;
    document.getElementById('startDate').value      = promo.start_date ? promo.start_date.replace(' ', 'T').slice(0,16) : '';
    document.getElementById('endDate').value        = promo.end_date ? promo.end_date.replace(' ', 'T').slice(0,16) : '';
    document.getElementById('isActive').checked     = promo.status === 'active';
};

window.togglePromotion = function(pk){
    const idx = promotions.findIndex(p => (p.discount_id ?? '') === pk);
    if (idx < 0) return;
    promotions[idx].status = promotions[idx].status === 'active' ? 'paused' : 'active';
    renderPromotions();
    showNotification(`Khuyến mãi đã được ${promotions[idx].status === 'active' ? 'kích hoạt' : 'tạm dừng'}!`);
    // TODO: gọi API update status nếu cần
};

window.deletePromotion = function(pk){
    const confirmDialog = document.createElement('div');
    confirmDialog.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
    confirmDialog.innerHTML = `
        <div class="bg-white p-6 rounded-lg shadow-xl max-w-md w-full mx-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Xác nhận xóa</h3>
            <p class="text-gray-600 mb-6">Bạn có chắc chắn muốn xóa khuyến mãi này? Hành động này không thể hoàn tác.</p>
            <div class="flex justify-end space-x-4">
                <button id="cancelDelete" class="px-4 py-2 text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">Hủy</button>
                <button id="confirmDelete" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">Xóa</button>
            </div>
        </div>`;
    document.body.appendChild(confirmDialog);
    document.getElementById('cancelDelete').onclick = () => document.body.removeChild(confirmDialog);
    document.getElementById('confirmDelete').onclick = async () => {
        // UI remove
        promotions = promotions.filter(p => (p.discount_id ?? '') !== pk);
        renderPromotions();
        showNotification('Khuyến mãi đã được xóa thành công!');
        // TODO: gọi API DELETE nếu cần
        document.body.removeChild(confirmDialog);
    };
};

/** ====== FILTER ====== */
function filterPromotions(){
    const term = (searchInput.value || '').toLowerCase();
    const st = statusFilter.value;
    const tp = typeFilter.value;
    const filtered = promotions.filter(p => {
        const code = (p.code || '').toLowerCase();
        const matchSearch = code.includes(term); // DB chưa có name -> search theo code
        const matchStatus = !st || p.status === st;
        const matchType   = !tp || p.type === tp;
        return matchSearch && matchStatus && matchType;
    });
    renderPromotions(filtered);
}

/** ====== NOTIFY ====== */
function showNotification(message, type='success'){
    const n = document.createElement('div');
    n.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg text-white fade-in ${type==='success' ? 'bg-green-500' : 'bg-red-500'}`;
    n.textContent = message;
    document.body.appendChild(n);
    setTimeout(()=> n.remove(), 3000);
}

/** ====== EVENTS ====== */
if (createPromoBtn) createPromoBtn.addEventListener('click', openModal);
if (closeModal)    closeModal.addEventListener('click', closeModalFunc);
if (cancelBtn)     cancelBtn.addEventListener('click', closeModalFunc);

// Submit form: demo thêm nhanh vào UI.
// Bật API thật bằng cách bỏ comment khối fetch POST bên dưới.
if (promotionForm) {
    promotionForm.addEventListener('submit', async (e)=>{
        e.preventDefault();
        const fd = new FormData(promotionForm);

        // === DÙNG API THẬT (nếu đã khai báo route POST) ===
        /*
        const res = await fetch('{{ route('admin.promotions.store') }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            body: fd
        });
        const result = await res.json();
        if (result?.success) {
            await loadPromotions();
            closeModalFunc();
            showNotification(result.message || 'Tạo khuyến mãi thành công!');
            return;
        } else {
            showNotification('Tạo khuyến mãi thất bại!', 'error');
            return;
        }
        */

        // === DEMO UI (không gọi API) ===
        promotions.unshift({
            discount_id: String(Date.now()),
            code       : fd.get('promoCode') || '',
            type       : fd.get('discountType') || 'percentage',
            value      : parseFloat(fd.get('discountValue') || '0'),
            status     : document.getElementById('isActive').checked ? 'active' : 'scheduled',
            start_date : fd.get('startDate')?.replace('T',' ') || null,
            end_date   : fd.get('endDate')?.replace('T',' ') || null,
        });
        renderPromotions();
        closeModalFunc();
        showNotification('Khuyến mãi đã được tạo thành công!');
    });
}

if (searchInput)  searchInput.addEventListener('input',  filterPromotions);
if (statusFilter) statusFilter.addEventListener('change', filterPromotions);
if (typeFilter)   typeFilter.addEventListener('change',   filterPromotions);
if (exportExcelBtn) exportExcelBtn.addEventListener('click', () => {
    // 'dom' = xuất đúng dữ liệu đang hiển thị; đổi 'state' nếu muốn toàn bộ từ promotions (không phân trang)
    exportPromotions('excel', 'dom');
});
if (exportPdfBtn) exportPdfBtn.addEventListener('click', () => {
    exportPromotions('pdf', 'dom');
});
if (promotionModal) promotionModal.addEventListener('click', (e)=> { if(e.target === promotionModal) closeModalFunc(); });

/** ====== INIT ====== */
document.addEventListener('DOMContentLoaded', loadPromotions);
</script>

@endsection