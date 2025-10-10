<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách khách hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>
<body class="bg-gray-100 p-6">

<div id="customers" class="section">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Danh sách khách hàng</h2>
            <p class="text-gray-600 mt-1">Khách hàng tự đăng ký tài khoản trên website</p>
        </div>
        <div class="flex space-x-2">
            <button id="exportExcel" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
                <i class="fas fa-download mr-2"></i>Xuất Excel
            </button>
            <button class="bg-blue-100 text-blue-700 px-4 py-2 rounded-lg hover:bg-blue-200 transition-colors">
                <i class="fas fa-filter mr-2"></i>Bộ lọc
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6 border-b">
            <div class="flex space-x-4">
                <input id="searchInput" type="text" placeholder="Tìm kiếm khách hàng..." class="flex-1 border rounded-lg px-4 py-2">
                <select id="statusSelect" class="border rounded-lg px-4 py-2">
                    <option>Tất cả trạng thái</option>
                    <option>Hoạt động</option>
                    <option>Không hoạt động</option>
                </select>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table id="customerTable" class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tên khách hàng</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Số điện thoại</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#001</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Nguyễn Văn A</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">nguyenvana@email.com</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">0123456789</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Hoạt động</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-blue-600 hover:text-blue-900 mr-3 edit-btn">Sửa</button>
                            <button class="text-red-600 hover:text-red-900 delete-btn">Xóa</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#002</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Trần Thị B</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">tranthib@email.com</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">0987654321</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Hoạt động</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-blue-600 hover:text-blue-900 mr-3 edit-btn">Sửa</button>
                            <button class="text-red-600 hover:text-red-900 delete-btn">Xóa</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal sửa khách hàng -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg w-96 p-6 relative">
        <h3 class="text-xl font-bold mb-4">Sửa khách hàng</h3>
        <form id="editForm" class="space-y-3">
            <input type="hidden" id="editRowIndex">
            <div>
                <label class="block text-sm font-medium">Tên</label>
                <input type="text" id="editName" class="border rounded w-full px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="email" id="editEmail" class="border rounded w-full px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Số điện thoại</label>
                <input type="text" id="editPhone" class="border rounded w-full px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Trạng thái</label>
                <select id="editStatus" class="border rounded w-full px-3 py-2">
                    <option value="Hoạt động">Hoạt động</option>
                    <option value="Không hoạt động">Không hoạt động</option>
                </select>
            </div>
            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" id="cancelEdit" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Hủy</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Lưu</button>
            </div>
        </form>
        <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-lg">&times;</button>
    </div>
</div>

<!-- Modal xác nhận xóa -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg w-80 p-6 relative">
        <h3 class="text-lg font-bold mb-4">Xác nhận xóa</h3>
        <p class="mb-4">Bạn có chắc chắn muốn xóa khách hàng <span id="deleteCustomerName" class="font-semibold"></span>?</p>
        <div class="flex justify-end space-x-2">
            <button id="cancelDelete" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Hủy</button>
            <button id="confirmDelete" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Xóa</button>
        </div>
        <button id="closeDeleteModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-lg">&times;</button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const statusSelect = document.getElementById('statusSelect');
    const tableBody = document.querySelector('#customerTable tbody');
    const exportBtn = document.getElementById('exportExcel');

    const editModal = document.getElementById('editModal');
    const editForm = document.getElementById('editForm');
    const editRowIndex = document.getElementById('editRowIndex');
    const editName = document.getElementById('editName');
    const editEmail = document.getElementById('editEmail');
    const editPhone = document.getElementById('editPhone');
    const editStatus = document.getElementById('editStatus');
    const closeModal = document.getElementById('closeModal');
    const cancelEdit = document.getElementById('cancelEdit');

    const deleteModal = document.getElementById('deleteModal');
    const deleteCustomerName = document.getElementById('deleteCustomerName');
    const cancelDelete = document.getElementById('cancelDelete');
    const confirmDelete = document.getElementById('confirmDelete');
    const closeDeleteModal = document.getElementById('closeDeleteModal');
    let rowToDelete = null;

    const rows = Array.from(tableBody.querySelectorAll('tr'));

    // Tìm kiếm khách hàng
    searchInput.addEventListener('input', () => {
        const query = searchInput.value.toLowerCase();
        rows.forEach(row => {
            const name = row.cells[1].textContent.toLowerCase();
            const email = row.cells[2].textContent.toLowerCase();
            const phone = row.cells[3].textContent.toLowerCase();
            row.style.display = (name.includes(query) || email.includes(query) || phone.includes(query)) ? '' : 'none';
        });
    });

    // Lọc trạng thái
    statusSelect.addEventListener('change', () => {
        const filter = statusSelect.value;
        rows.forEach(row => {
            const status = row.cells[4].textContent.trim();
            row.style.display = (filter === 'Tất cả trạng thái' || filter === status) ? '' : 'none';
        });
    });

    // Click vào bảng
    tableBody.addEventListener('click', e => {
        const row = e.target.closest('tr');

        // Mở modal sửa
        if(e.target.classList.contains('edit-btn')) {
            editRowIndex.value = rows.indexOf(row);
            editName.value = row.cells[1].textContent;
            editEmail.value = row.cells[2].textContent;
            editPhone.value = row.cells[3].textContent;
            editStatus.value = row.cells[4].textContent.trim();
            editModal.classList.remove('hidden');
        }

        // Mở modal xóa
        if(e.target.classList.contains('delete-btn')) {
            rowToDelete = row;
            deleteCustomerName.textContent = row.cells[1].textContent;
            deleteModal.classList.remove('hidden');
        }
    });

    // Modal Sửa
    closeModal.addEventListener('click', () => editModal.classList.add('hidden'));
    cancelEdit.addEventListener('click', () => editModal.classList.add('hidden'));
    editForm.addEventListener('submit', e => {
        e.preventDefault();
        const index = parseInt(editRowIndex.value);
        const row = rows[index];
        row.cells[1].textContent = editName.value;
        row.cells[2].textContent = editEmail.value;
        row.cells[3].textContent = editPhone.value;
        row.cells[4].innerHTML = `<span class="${editStatus.value==='Hoạt động'?'bg-green-100 text-green-800':'bg-red-100 text-red-800'} px-2 py-1 rounded text-sm">${editStatus.value}</span>`;
        editModal.classList.add('hidden');
    });

    // Modal Xóa
    cancelDelete.addEventListener('click', () => { rowToDelete = null; deleteModal.classList.add('hidden'); });
    closeDeleteModal.addEventListener('click', () => { rowToDelete = null; deleteModal.classList.add('hidden'); });
    confirmDelete.addEventListener('click', () => {
        if(rowToDelete) rowToDelete.remove();
        rowToDelete = null;
        deleteModal.classList.add('hidden');
    });

    // Xuất Excel
    exportBtn.addEventListener('click', () => {
        const visibleRows = rows.filter(row => row.style.display !== 'none');
        const data = visibleRows.map(row => ({
            ID: row.cells[0].textContent,
            Tên: row.cells[1].textContent,
            Email: row.cells[2].textContent,
            Số_điện_thoại: row.cells[3].textContent,
            Trạng_thái: row.cells[4].textContent.trim()
        }));
        const ws = XLSX.utils.json_to_sheet(data);
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "KhachHang");
        XLSX.writeFile(wb, "Danh_sach_khach_hang.xlsx");
    });
});
</script>
</body>
</html>
