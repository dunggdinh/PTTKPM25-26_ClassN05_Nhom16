@extends('admin.layout')
@section('title', 'Quản lý khách hàng')
@section('content')
<div class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Quản Lý Khách Hàng</h1>
            <p class="text-gray-600">Quản lý thông tin và hoạt động của khách hàng</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-blue-100 mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Tổng khách hàng</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalCustomers }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-green-100 mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Tổng quản trị viên</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalAdmins }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-yellow-100 mr-4">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Mới hôm nay</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $newToday }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-purple-100 mr-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Tăng trưởng</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $growth }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Actions -->
            <div class="bg-white rounded-xl shadow-md">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Danh sách người dùng</h2>
                    <!-- Filters and Search -->
                        <form method="GET" action="{{ route('admin.user') }}" 
                            class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">

                            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                                <div class="relative">
                                    <input type="text" name="search" placeholder="Tìm kiếm khách hàng..." 
                                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent w-full md:w-64"
                                        value="{{ request('search') }}">
                                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <!-- Trạng thái -->
                                <select name="role" 
                                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                    <option value="">Tất cả vai trò</option>
                                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="customer" {{ request('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                                </select>
                            </div> 

                            <div class="flex space-x-3">
                                <button type="button" onclick="exportUsers('pdf')"
                                        class="bg-red-600 hover:bg-red-700 text-white border border-red-600 px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v8m0 0H8m4 0h4M6 4h12l-1 16H7L6 4z"></path>
                                    </svg>
                                    <span>Xuất PDF</span>
                                </button>


                                <a href="{{ route('admin.user') }}"
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


        <!-- Customer Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-x-auto">
            <table id="usersTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã người dùng</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Người dùng</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày sinh</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Giới tính</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số điện thoại</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Địa chỉ</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày tham gia</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $user)
                    <tr>
                        <td class="px-6 py-4">{{ $user->user_id }}</td>
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">{{ ucfirst($user->role) }}</td>
                        <td class="px-6 py-4">{{ $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->format('d/m/Y') : '-' }}</td>
                        <td class="px-6 py-4">{{ $user->gender ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $user->phone ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $user->address ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $user->created_at ? $user->created_at->format('d/m/Y') : '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
                <div class="flex flex-col items-center mt-4 bg-white px-4 py-2 rounded-b-xl">
                    <div>
                        {{ $users->withQueryString()->links('pagination::simple-tailwind') }}
                    </div>

                    <div class="text-sm text-gray-500 mt-1">
                        Trang {{ $users->currentPage() }} / {{ $users->lastPage() }}
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
// ====== Helper: nạp 1 font serif hỗ trợ tiếng Việt từ CDN cho jsPDF ======
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

// ====== Helper: chuẩn hoá Unicode về NFC + bỏ NBSP ======
function vn(t) {
  if (t === null || t === undefined) return '';
  try { t = t.toString().normalize('NFC'); } catch {}
  return t.replace(/\u00A0/g, ' ');
}

// ====== Gom dữ liệu từ bảng hiện tại (đang hiển thị) ======
function getUsersTableData() {
  const table = document.getElementById('usersTable');
  const headers = Array.from(table.querySelectorAll('thead th')).map(th => vn(th.innerText.trim()));
  const rows = Array.from(table.querySelectorAll('tbody tr')).map(tr =>
      Array.from(tr.querySelectorAll('td')).map(td => vn(td.innerText.trim()))
  );
  return { headers, rows };
}

// ====== Export Excel hoặc PDF ======
async function exportUsers(type) {
  const { headers, rows } = getUsersTableData();
  const fileName = `users-{{ now()->format('Y-m-d') }}`;

  if (type === 'excel') {
    // Excel: export đúng những gì đang hiển thị trong bảng
    const wb = XLSX.utils.book_new();
    const sheet = XLSX.utils.aoa_to_sheet([headers, ...rows]);
    XLSX.utils.book_append_sheet(wb, sheet, 'Users');
    XLSX.writeFile(wb, `${fileName}.xlsx`);
    return;
  }

  if (type === 'pdf') {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // 1) Nạp font Unicode
    await loadCDNFont(doc);
    doc.setFont("SerifVN");
    doc.setCharSpace(0);
    doc.setLineHeightFactor(1.15);

    // 2) Hooks: ép mọi cell dùng font + normalize
    const tableHooks = {
      didParseCell: (data) => {
        data.cell.styles.font = 'SerifVN';
        data.cell.styles.fontStyle = 'normal';
        if (Array.isArray(data.cell.text)) {
          data.cell.text = data.cell.text.map(vn);
        } else if (typeof data.cell.text === 'string') {
          data.cell.text = vn(data.cell.text);
        }
      },
      willDrawCell: (data) => { data.doc.setCharSpace(0); }
    };

    // 3) Render tiêu đề + bảng
    doc.setFontSize(16);
    doc.text(vn("Danh sách người dùng"), 14, 18);

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
    const roleFilter = document.querySelector("select[name='role']");
    const reloadBtn = document.getElementById("reload-btn");
    const tableBody = document.getElementById("userTable");

    // --- Lọc dữ liệu ---
    if (roleFilter) {
        roleFilter.addEventListener("change", () => applyFilters());
    }

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
        if (searchInput) params.set("search", searchInput.value);
        if (roleFilter) params.set("role", roleFilter.value);
        window.location.search = params.toString();
    }

    // --- Làm mới (AJAX) ---
    if (reloadBtn) {
        reloadBtn.addEventListener("click", async function(e) {
            e.preventDefault();
            tableBody.innerHTML = `<tr><td colspan="9" class="text-center py-4">Đang tải dữ liệu...</td></tr>`;
            try {
                const response = await fetch(this.dataset.url, { 
                    headers: { "X-Requested-With": "XMLHttpRequest" } 
                });
                const data = await response.json();
                tableBody.innerHTML = data.html || `<tr><td colspan="9" class="text-center text-red-500">Không có dữ liệu.</td></tr>`;
            } catch (error) {
                tableBody.innerHTML = `<tr><td colspan="9" class="text-center text-red-500">Lỗi khi tải dữ liệu.</td></tr>`;
            }
        });
    }
});
</script>

@endsection
