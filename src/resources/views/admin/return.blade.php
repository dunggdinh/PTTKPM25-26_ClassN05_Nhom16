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
                        <p class="text-2xl font-semibold text-gray-900" id="pendingCount">{{ $stats['pending'] }}</p>
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
                        <p class="text-2xl font-semibold text-gray-900" id="processingCount">{{ $stats['processing'] }}</p>
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
                        <p class="text-2xl font-semibold text-gray-900" id="completedCount">{{ $stats['completed'] }}</p>
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
                        <p class="text-2xl font-semibold text-gray-900" id="rejectedCount">{{ $stats['rejected'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters + Action -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tìm kiếm</label>
                    <input type="text" id="searchInput" placeholder="Mã yêu cầu, tên KH, sản phẩm..."
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái</label>
                    <select id="statusFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Tất cả trạng thái</option>
                        <option value="pending">Chờ xử lý</option>
                        <option value="processing">Đang xử lý</option>
                        <option value="approved">Đã duyệt</option>
                        <option value="rejected">Từ chối</option>
                        <option value="completed">Hoàn thành</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Loại yêu cầu</label>
                    <select id="typeFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Tất cả</option>
                        <option value="return">Trả hàng</option>
                        <option value="exchange">Đổi hàng</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ngày tạo</label>
                    <input type="date" id="dateFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>

            <div class="mt-4 flex gap-3">
                <button type="button" onclick="exportReturns('pdf')"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Xuất PDF
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Danh sách yêu cầu đổi/trả</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <input type="checkbox" id="selectAll" onchange="toggleSelectAll()" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã yêu cầu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Khách hàng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sản phẩm</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Loại</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lý do</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày tạo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="returnsTableBody" class="bg-white divide-y divide-gray-200"></tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="bg-white px-6 py-3 flex items-center justify-between border-t border-gray-200 mt-6 rounded-lg shadow-sm">
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between w-full">
                <div>
                    <p class="text-sm text-gray-700">
                        Hiển thị <span class="font-medium" id="showingFrom">1</span> đến
                        <span class="font-medium" id="showingTo">10</span> trong tổng số
                        <span class="font-medium" id="totalRecords">0</span> kết quả
                    </p>
                </div>
                <div>
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                        <button onclick="previousPage()" id="prevBtn" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span class="sr-only">Trước</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div id="pageNumbers" class="relative inline-flex items-center"></div>
                        <button onclick="nextPage()" id="nextBtn" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span class="sr-only">Sau</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </main>

    <!-- Detail Modal -->
    <div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Chi tiết yêu cầu đổi/trả</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="modalContent" class="space-y-4"></div>
                <div class="flex justify-end space-x-3 mt-6 pt-4 border-t">
                    <button onclick="closeModal()" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg">Đóng</button>
                    <button id="approveBtn" onclick="approveRequest()" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">Duyệt yêu cầu</button>
                    <button id="rejectBtn" onclick="rejectRequest()" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">Từ chối</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SheetJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<!-- jsPDF + AutoTable -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.1/jspdf.plugin.autotable.min.js"></script>

<script>
// ======= DATA DEMO =======
let returnsData = [
  {id:'RT001', customer:'Nguyễn Văn An', email:'an.nguyen@email.com', phone:'0901234567',
   product:'iPhone 14 Pro Max 256GB', orderId:'ORD001', type:'return', reason:'Sản phẩm bị lỗi màn hình',
   status:'pending', createdDate:'2024-01-15', amount:29990000, description:'Màn hình bị vỡ góc, không thể sử dụng bình thường'},
  // ... (giữ nguyên các item còn lại của bạn)
  {id:'RT012', customer:'Hoàng Thị Quỳnh', email:'quynh.hoang@email.com', phone:'0912345679',
   product:'Dyson V15 Detect', orderId:'ORD012', type:'return', reason:'Quá nặng',
   status:'processing', createdDate:'2024-01-04', amount:19990000, description:'Máy hút bụi quá nặng, không phù hợp với người già'}
];

let currentPage = 1;
let itemsPerPage = 5;
let filteredData = [...returnsData];
let currentRequestId = null;
let selectedItems = new Set();

// ======= Helpers =======
function getStatusText(s) {
  return {pending:'Chờ xử lý',processing:'Đang xử lý',approved:'Đã duyệt',rejected:'Từ chối',completed:'Hoàn thành'}[s] || s;
}
function formatDate(d){ return new Date(d).toLocaleDateString('vi-VN'); }

function actionButtons(item){
  if(item.status !== 'pending') return '';
  return ''
    + '<button onclick="quickApprove(\''+item.id+'\')" class="text-green-600 hover:text-green-900 mr-3">Duyệt</button>'
    + '<button onclick="quickReject(\''+item.id+'\')" class="text-red-600 hover:text-red-900">Từ chối</button>';
}

// ======= Render =======
function renderTable(){
  const tbody = document.getElementById('returnsTableBody');
  const startIndex = (currentPage - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  const pageData = filteredData.slice(startIndex, endIndex);

  const rows = pageData.map(item => (
    '<tr class="hover:bg-gray-50">'
    + '<td class="px-6 py-4 whitespace-nowrap">'
      + '<input type="checkbox" '+(selectedItems.has(item.id)?'checked':'')+' onchange="toggleSelectItem(\''+item.id+'\')" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">'
    + '</td>'
    + '<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">'+item.id+'</td>'
    + '<td class="px-6 py-4 whitespace-nowrap"><div class="text-sm font-medium text-gray-900">'+item.customer+'</div><div class="text-sm text-gray-500">'+item.email+'</div></td>'
    + '<td class="px-6 py-4"><div class="text-sm font-medium text-gray-900">'+item.product+'</div><div class="text-sm text-gray-500">Đơn hàng: '+item.orderId+'</div></td>'
    + '<td class="px-6 py-4 whitespace-nowrap"><span class="px-2 py-1 text-xs font-medium rounded-full '+(item.type==='return'?'bg-red-100 text-red-800':'bg-blue-100 text-blue-800')+'">'+(item.type==='return'?'Trả hàng':'Đổi hàng')+'</span></td>'
    + '<td class="px-6 py-4 text-sm text-gray-900">'+item.reason+'</td>'
    + '<td class="px-6 py-4 whitespace-nowrap"><span class="px-2 py-1 text-xs font-medium rounded-full status-'+item.status+'">'+getStatusText(item.status)+'</span></td>'
    + '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">'+formatDate(item.createdDate)+'</td>'
    + '<td class="px-6 py-4 whitespace-nowrap text-sm font-medium">'
      + '<button onclick="viewDetail(\''+item.id+'\')" class="text-blue-600 hover:text-blue-900 mr-3">Xem</button>'
      + actionButtons(item)
    + '</td>'
    + '</tr>'
  )).join('');

  tbody.innerHTML = rows;
  updatePagination();
  updateSelectAllCheckbox();
}

function updatePagination(){
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  const startIndex = (currentPage - 1) * itemsPerPage + 1;
  const endIndex = Math.min(currentPage * itemsPerPage, filteredData.length);

  document.getElementById('showingFrom').textContent = filteredData.length ? startIndex : 0;
  document.getElementById('showingTo').textContent = endIndex;
  document.getElementById('totalRecords').textContent = filteredData.length;

  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  const pageNumbers = document.getElementById('pageNumbers');

  prevBtn.disabled = currentPage <= 1;
  nextBtn.disabled = currentPage >= totalPages;

  let html = '';
  if (totalPages <= 7){
    for (let i=1;i<=totalPages;i++){
      html += '<button onclick="goToPage('+i+')" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium '+(i===currentPage?'text-blue-600 bg-blue-50 border-blue-500':'text-gray-700 hover:bg-gray-50')+'">'+i+'</button>';
    }
  } else {
    if (currentPage <= 4){
      for (let i=1;i<=5;i++){
        html += '<button onclick="goToPage('+i+')" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium '+(i===currentPage?'text-blue-600 bg-blue-50 border-blue-500':'text-gray-700 hover:bg-gray-50')+'">'+i+'</button>';
      }
      html += '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
      html += '<button onclick="goToPage('+totalPages+')" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">'+totalPages+'</button>';
    } else if (currentPage >= totalPages - 3){
      html += '<button onclick="goToPage(1)" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">1</button>';
      html += '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
      for (let i=totalPages-4;i<=totalPages;i++){
        html += '<button onclick="goToPage('+i+')" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium '+(i===currentPage?'text-blue-600 bg-blue-50 border-blue-500':'text-gray-700 hover:bg-gray-50')+'">'+i+'</button>';
      }
    } else {
      html += '<button onclick="goToPage(1)" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">1</button>';
      html += '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
      for (let i=currentPage-1;i<=currentPage+1;i++){
        html += '<button onclick="goToPage('+i+')" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium '+(i===currentPage?'text-blue-600 bg-blue-50 border-blue-500':'text-gray-700 hover:bg-gray-50')+'">'+i+'</button>';
      }
      html += '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
      html += '<button onclick="goToPage('+totalPages+')" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">'+totalPages+'</button>';
    }
  }
  pageNumbers.innerHTML = html;
}

// ======= Filters =======
function applyFilters(){
  const s = document.getElementById('searchInput').value.toLowerCase();
  const st = document.getElementById('statusFilter').value;
  const tp = document.getElementById('typeFilter').value;
  const dt = document.getElementById('dateFilter').value;

  filteredData = returnsData.filter(item => {
    const matchesSearch = !s || item.id.toLowerCase().includes(s) || item.customer.toLowerCase().includes(s) || item.product.toLowerCase().includes(s);
    const matchesStatus = !st || item.status === st;
    const matchesType = !tp || item.type === tp;
    const matchesDate = !dt || item.createdDate === dt;
    return matchesSearch && matchesStatus && matchesType && matchesDate;
  });
  currentPage = 1;
  renderTable();
  updateStatistics();
}

function updateStatistics(){
  const stats = filteredData.reduce((a,it)=>{ a[it.status]=(a[it.status]||0)+1; return a; },{});
  document.getElementById('pendingCount').textContent = stats.pending || 0;
  document.getElementById('processingCount').textContent = stats.processing || 0;
  document.getElementById('completedCount').textContent = (stats.completed||0)+(stats.approved||0);
  document.getElementById('rejectedCount').textContent = stats.rejected || 0;
}

// ======= Paging buttons =======
function previousPage(){ if (currentPage>1){ currentPage--; renderTable(); } }
function nextPage(){ const totalPages = Math.ceil(filteredData.length/itemsPerPage); if (currentPage<totalPages){ currentPage++; renderTable(); } }
function goToPage(p){ const totalPages = Math.ceil(filteredData.length/itemsPerPage); if(p>=1 && p<=totalPages){ currentPage=p; renderTable(); } }

// ======= Row actions / modal =======
function viewDetail(id){
  const item = returnsData.find(r=>r.id===id); if(!item) return;
  currentRequestId = id;

  document.getElementById('modalTitle').textContent = `Chi tiết yêu cầu ${item.type==='return'?'trả hàng':'đổi hàng'} - ${item.id}`;
  document.getElementById('modalContent').innerHTML =
    '<div class="grid grid-cols-1 md:grid-cols-2 gap-4">'
    + '<div><h4 class="font-medium text-gray-900 mb-2">Thông tin khách hàng</h4>'
      + '<div class="space-y-2 text-sm">'
        + '<p><span class="font-medium">Tên:</span> '+item.customer+'</p>'
        + '<p><span class="font-medium">Email:</span> '+item.email+'</p>'
        + '<p><span class="font-medium">Điện thoại:</span> '+item.phone+'</p>'
      + '</div></div>'
    + '<div><h4 class="font-medium text-gray-900 mb-2">Thông tin đơn hàng</h4>'
      + '<div class="space-y-2 text-sm">'
        + '<p><span class="font-medium">Mã đơn hàng:</span> '+item.orderId+'</p>'
        + '<p><span class="font-medium">Sản phẩm:</span> '+item.product+'</p>'
        + '<p><span class="font-medium">Giá trị:</span> '+Number(item.amount||0).toLocaleString("vi-VN")+' ₫</p>'
      + '</div></div>'
    + '</div>'
    + '<div class="mt-4"><h4 class="font-medium text-gray-900 mb-2">Chi tiết yêu cầu</h4>'
      + '<div class="space-y-2 text-sm">'
        + '<p><span class="font-medium">Loại:</span> '+(item.type==='return'?'Trả hàng':'Đổi hàng')+'</p>'
        + '<p><span class="font-medium">Lý do:</span> '+item.reason+'</p>'
        + '<p><span class="font-medium">Mô tả:</span> '+item.description+'</p>'
        + '<p><span class="font-medium">Trạng thái:</span> <span class="px-2 py-1 text-xs font-medium rounded-full status-'+item.status+'">'+getStatusText(item.status)+'</span></p>'
        + '<p><span class="font-medium">Ngày tạo:</span> '+formatDate(item.createdDate)+'</p>'
      + '</div></div>';
  const approveBtn = document.getElementById('approveBtn');
  const rejectBtn = document.getElementById('rejectBtn');
  if(item.status==='pending'){ approveBtn.style.display='block'; rejectBtn.style.display='block'; } else { approveBtn.style.display='none'; rejectBtn.style.display='none'; }
  document.getElementById('detailModal').classList.remove('hidden');
}
function closeModal(){ document.getElementById('detailModal').classList.add('hidden'); currentRequestId=null; }

function quickApprove(id){ if(confirm('Bạn có chắc chắn muốn duyệt yêu cầu này?')) updateRequestStatus(id,'approved'); }
function quickReject(id){ const reason = prompt('Nhập lý do từ chối:'); if(reason && reason.trim()) updateRequestStatus(id,'rejected'); }
function approveRequest(){ if(currentRequestId && confirm('Bạn có chắc chắn muốn duyệt yêu cầu này?')){ updateRequestStatus(currentRequestId,'approved'); closeModal(); } }
function rejectRequest(){ if(currentRequestId){ const reason = prompt('Nhập lý do từ chối:'); if(reason && reason.trim()){ updateRequestStatus(currentRequestId,'rejected'); closeModal(); } } }

function updateRequestStatus(id, newStatus){
  const idx = returnsData.findIndex(i=>i.id===id);
  if(idx===-1) return showNotification('❌ Không tìm thấy yêu cầu để cập nhật!','error');
  returnsData[idx].status = newStatus;
  returnsData[idx].lastUpdated = new Date().toISOString();

  const fIdx = filteredData.findIndex(i=>i.id===id);
  if(fIdx!==-1){ filteredData[fIdx].status=newStatus; filteredData[fIdx].lastUpdated=returnsData[idx].lastUpdated; }

  renderTable(); updateStatistics();
  showNotification(`✅ Yêu cầu ${id} đã được ${newStatus==='approved'?'duyệt':'từ chối'} thành công!`,'success');
}

function showNotification(message,type='info'){
  const el=document.createElement('div');
  el.className='fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 '+(type==='success'?'bg-green-500 text-white':type==='error'?'bg-red-500 text-white':'bg-blue-500 text-white');
  el.textContent=message; document.body.appendChild(el); setTimeout(()=>el.remove(),3000);
}

// ======= Select all / item =======
function toggleSelectAll(){
  const selectAll = document.getElementById('selectAll');
  const curr = filteredData.slice((currentPage-1)*itemsPerPage, currentPage*itemsPerPage);
  if(selectAll.checked){ curr.forEach(i=>selectedItems.add(i.id)); } else { curr.forEach(i=>selectedItems.delete(i.id)); }
  renderTable(); updateSelectAllCheckbox();
}
function toggleSelectItem(id){ if(selectedItems.has(id)) selectedItems.delete(id); else selectedItems.add(id); updateSelectAllCheckbox(); }
function updateSelectAllCheckbox(){
  const selectAll = document.getElementById('selectAll');
  const curr = filteredData.slice((currentPage-1)*itemsPerPage, currentPage*itemsPerPage);
  const selectedCurr = curr.filter(i=>selectedItems.has(i.id));
  if(selectedCurr.length===0){ selectAll.checked=false; selectAll.indeterminate=false; }
  else if(selectedCurr.length===curr.length){ selectAll.checked=true; selectAll.indeterminate=false; }
  else { selectAll.checked=false; selectAll.indeterminate=true; }
}

// ======= Export (Excel / PDF) =======
function buildReturnExport(){
  const data = filteredData.slice();
  const headers = ['Mã yêu cầu','Khách hàng','Email','Số điện thoại','Sản phẩm','Mã đơn','Loại','Lý do','Giá trị','Trạng thái','Ngày tạo'];
  const rows = data.map(it => ([
    it.id, it.customer, it.email||'', it.phone||'', it.product, it.orderId,
    (it.type==='return'?'Trả hàng':'Đổi hàng'),
    it.reason||'',
    (Number(it.amount||0)).toLocaleString('vi-VN'),
    getStatusText(it.status),
    new Date(it.createdDate).toLocaleDateString('vi-VN')
  ]));
  const file = 'danh-sach-doi-tra-hang';
  const timestamp = new Date().toISOString().split('T')[0];
  return { headers, rows, file, timestamp };
}

function exportReturns(kind){
  if(kind==='excel') return exportReturnsExcel();
  if(kind==='pdf') return exportReturnsPDF();
}

function exportReturnsExcel(){
  const { headers, rows, file, timestamp } = buildReturnExport();
  const wb = XLSX.utils.book_new();
  const aoa = [[`Xuất lúc: ${new Date().toLocaleString('vi-VN')}`], [], headers, ...rows];
  XLSX.utils.book_append_sheet(wb, XLSX.utils.aoa_to_sheet(aoa), 'Returns');

  const statusIndex = headers.indexOf('Trạng thái');
  const stats = {}; rows.forEach(r => { const k=r[statusIndex]; stats[k]=(stats[k]||0)+1; });
  const sum = [['Thống kê tổng quan'],['Tổng số yêu cầu', rows.length],[],['Trạng thái','Số lượng'],...Object.entries(stats)];
  XLSX.utils.book_append_sheet(wb, XLSX.utils.aoa_to_sheet(sum), 'Summary');

  XLSX.writeFile(wb, `${file}-${timestamp}.xlsx`);
  showNotification('Đã xuất Excel!','success');
}

// ===== Font Unicode từ CDN cho jsPDF (giống trang Kho) =====
async function loadCDNFont(doc) {
  const sources = [
    "https://cdn.jsdelivr.net/gh/googlefonts/noto-fonts@main/hinted/ttf/NotoSans/NotoSans-Regular.ttf",
    "https://cdn.jsdelivr.net/gh/dejavu-fonts/dejavu-fonts-ttf@version_2_37/ttf/DejaVuSans.ttf"
  ];
  let base64 = null, postName = "VNFont";
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

// === THAY HÀM NÀY: Export PDF với font Unicode ===
async function exportReturnsPDF() {
  const { headers, rows, file, timestamp } = buildReturnExport();
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF({ orientation: 'landscape' });

  // 1) Nạp font Unicode + chỉnh spacing/line-height
  await loadCDNFont(doc);
  doc.setFont("VNFont");           // dùng font Unicode
  doc.setCharSpace(0);
  doc.setLineHeightFactor(1.15);

  // 2) Hook: ép mọi cell dùng font + normalize tiếng Việt
  const tableHooks = {
    didParseCell: (data) => {
      data.cell.styles.font = 'VNFont';
      data.cell.styles.fontStyle = 'normal';
      if (Array.isArray(data.cell.text)) data.cell.text = data.cell.text.map(vn);
      else if (typeof data.cell.text === 'string') data.cell.text = vn(data.cell.text);
    },
    willDrawCell: (data) => { data.doc.setCharSpace(0); }
  };

  // 3) Tiêu đề
  doc.setFontSize(16);
  doc.text(vn('Báo cáo Đổi/Trả hàng'), 14, 14);
  doc.setFontSize(10);
  doc.text(vn(`Xuất lúc: ${new Date().toLocaleString('vi-VN')}`), 14, 20);

  // 4) Bảng dữ liệu
  doc.autoTable({
    startY: 26,
    head: [headers.map(vn)],
    body: rows.map(r => r.map(vn)),
    styles:     { font: 'VNFont', fontSize: 9, cellPadding: 2 },
    headStyles: { font: 'VNFont', fontSize: 9, fillColor: [59,130,246], textColor: [255,255,255] },
    theme: 'grid',
    ...tableHooks
  });

  // 5) Thống kê
  const lastY = doc.lastAutoTable.finalY + 8;
  const statusIdx = headers.indexOf('Trạng thái');
  const stats = {};
  rows.forEach(r => { const k = r[statusIdx]; stats[k] = (stats[k]||0)+1; });

  doc.text(vn('Thống kê tổng quan'), 14, lastY);
  doc.autoTable({
    startY: lastY + 3,
    head: [[vn('Trạng thái'), vn('Số lượng')]],
    body: Object.entries(stats).map(([k,v]) => [vn(k), v]),
    styles:     { font: 'VNFont', fontSize: 10, cellPadding: 2 },
    headStyles: { font: 'VNFont', fontSize: 10, fillColor: [16,185,129], textColor: [255,255,255] },
    theme: 'striped',
    ...tableHooks
  });

  doc.save(`${file}-${timestamp}.pdf`);
  showNotification('Đã xuất PDF!', 'success');
}

// ======= Init =======
function setupEventListeners(){
  document.getElementById('searchInput').addEventListener('input', debounce(applyFilters,300));
  document.getElementById('statusFilter').addEventListener('change', applyFilters);
  document.getElementById('typeFilter').addEventListener('change', applyFilters);
  document.getElementById('dateFilter').addEventListener('change', applyFilters);
}
function debounce(fn,wait){ let t; return (...a)=>{ clearTimeout(t); t=setTimeout(()=>fn(...a),wait); }; }

function init(){ renderTable(); updateStatistics(); setupEventListeners(); }
init();
</script>
@endsection
