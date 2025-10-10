<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách nhân viên</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">

<div class="container mx-auto">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Danh sách nhân viên</h2>
            <p class="text-gray-600 mt-1">Quản lý thông tin và quyền hạn nhân viên</p>
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center"
            onclick="openStaffModal()">
            <i class="fas fa-plus mr-2"></i>Thêm nhân viên
        </button>
    </div>

    <!-- Thống kê vai trò -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-purple-500 flex items-center">
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-crown text-purple-600"></i>
            </div>
            <div>
                <p id="adminCount" class="text-2xl font-bold text-gray-800">0</p>
                <p class="text-sm text-gray-600">Admin</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-blue-500 flex items-center">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-shopping-cart text-blue-600"></i>
            </div>
            <div>
                <p id="orderCount" class="text-2xl font-bold text-gray-800">0</p>
                <p class="text-sm text-gray-600">Order Manager</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-green-500 flex items-center">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-warehouse text-green-600"></i>
            </div>
            <div>
                <p id="storekeeperCount" class="text-2xl font-bold text-gray-800">0</p>
                <p class="text-sm text-gray-600">Storekeeper</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-yellow-500 flex items-center">
            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-headset text-yellow-600"></i>
            </div>
            <div>
                <p id="supportCount" class="text-2xl font-bold text-gray-800">0</p>
                <p class="text-sm text-gray-600">Support Staff</p>
            </div>
        </div>
    </div>

    <!-- Bộ lọc và tìm kiếm -->
    <div class="bg-white rounded-lg shadow-md mb-6 p-6 flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4">
            <div class="relative">
                <input type="text" id="staffSearch" oninput="filterStaff()" placeholder="Tìm kiếm nhân viên..."
                    class="pl-10 pr-4 py-2 border rounded-lg w-full md:w-64">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            <select id="roleFilter" onchange="filterStaff()" class="border rounded-lg px-4 py-2">
                <option value="">Tất cả chức vụ</option>
                <option value="Admin">Admin</option>
                <option value="Order Manager">Order Manager</option>
                <option value="Storekeeper">Storekeeper</option>
                <option value="Support Staff">Support Staff</option>
            </select>
            <select id="statusFilter" onchange="filterStaff()" class="border rounded-lg px-4 py-2">
                <option value="">Tất cả trạng thái</option>
                <option value="active">Hoạt động</option>
                <option value="inactive">Không hoạt động</option>
                <option value="suspended">Tạm khóa</option>
            </select>
        </div>
    </div>

    <!-- Bảng nhân viên -->
    <div class="bg-white rounded-lg shadow-md overflow-x-auto">
        <table class="w-full" id="staffTable">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nhân viên</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Chức vụ</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Thao tác</th>
                </tr>
            </thead>
            <tbody id="staffBody" class="divide-y divide-gray-200"></tbody>
        </table>
    </div>
</div>

<!-- Modal Thêm/Sửa -->
<div id="staffModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg w-full max-w-md p-6 relative">
        <h3 class="text-xl font-bold mb-4" id="modalTitle">Thêm nhân viên</h3>
        <form id="staffForm">
            <input type="hidden" id="staffId">
            <div class="mb-4">
                <label class="block text-gray-700">Tên nhân viên</label>
                <input type="text" id="staffName" class="w-full border rounded-lg px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Chức vụ</label>
                <select id="staffRole" class="w-full border rounded-lg px-3 py-2">
                    <option value="Admin">Admin</option>
                    <option value="Order Manager">Order Manager</option>
                    <option value="Storekeeper">Storekeeper</option>
                    <option value="Support Staff">Support Staff</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Trạng thái</label>
                <select id="staffStatus" class="w-full border rounded-lg px-3 py-2">
                    <option value="active">Hoạt động</option>
                    <option value="inactive">Không hoạt động</option>
                    <option value="suspended">Tạm khóa</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" id="staffEmail" class="w-full border rounded-lg px-3 py-2" required>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" class="px-4 py-2 bg-gray-200 rounded-lg" onclick="closeStaffModal()">Hủy</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Lưu</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    let staffList = [
        { id: "#NV001", name: "Nguyễn Văn A", role: "Admin", status: "active", email: "a.nguyen@email.com" },
        { id: "#NV002", name: "Trần Thị B", role: "Support Staff", status: "inactive", email: "b.tran@email.com" },
        { id: "#NV003", name: "Phạm Văn C", role: "Order Manager", status: "active", email: "c.pham@email.com" },
        { id: "#NV004", name: "Lê Thị D", role: "Storekeeper", status: "suspended", email: "d.le@email.com" }
    ];

    let editingStaffId = null;

    const staffBody = document.getElementById('staffBody');
    const staffModal = document.getElementById('staffModal');
    const staffForm = document.getElementById('staffForm');
    const modalTitle = document.getElementById('modalTitle');

    function renderStaff() {
        const searchText = document.getElementById('staffSearch').value.toLowerCase();
        const roleFilter = document.getElementById('roleFilter').value;
        const statusFilter = document.getElementById('statusFilter').value;

        staffBody.innerHTML = staffList
            .filter(staff => {
                return (
                    (staff.name.toLowerCase().includes(searchText) || staff.email.toLowerCase().includes(searchText)) &&
                    (roleFilter === "" || staff.role === roleFilter) &&
                    (statusFilter === "" || staff.status === statusFilter)
                );
            })
            .map(staff => `
                <tr>
                    <td class="px-6 py-3 whitespace-nowrap">${staff.name}</td>
                    <td class="px-6 py-3 whitespace-nowrap">${staff.role}</td>
                    <td class="px-6 py-3 whitespace-nowrap capitalize">${staff.status}</td>
                    <td class="px-6 py-3 whitespace-nowrap">${staff.email}</td>
                    <td class="px-6 py-3 whitespace-nowrap">
                        <button class="text-blue-600 hover:text-blue-900 mr-3" onclick="editStaff('${staff.id}')">Sửa</button>
                        <button class="text-red-600 hover:text-red-900" onclick="deleteStaff('${staff.id}')">Xóa</button>
                    </td>
                </tr>
            `).join('');

        updateRoleStats();
    }

    function updateRoleStats() {
        document.getElementById('adminCount').textContent = staffList.filter(s => s.role === 'Admin').length;
        document.getElementById('orderCount').textContent = staffList.filter(s => s.role === 'Order Manager').length;
        document.getElementById('storekeeperCount').textContent = staffList.filter(s => s.role === 'Storekeeper').length;
        document.getElementById('supportCount').textContent = staffList.filter(s => s.role === 'Support Staff').length;
    }

    window.filterStaff = renderStaff;

    window.openStaffModal = () => {
        editingStaffId = null;
        modalTitle.textContent = 'Thêm nhân viên';
        staffForm.reset();
        staffModal.classList.remove('hidden');
    };

    window.closeStaffModal = () => {
        staffModal.classList.add('hidden');
    };

    staffForm.addEventListener('submit', e => {
        e.preventDefault();
        const name = document.getElementById('staffName').value;
        const role = document.getElementById('staffRole').value;
        const status = document.getElementById('staffStatus').value;
        const email = document.getElementById('staffEmail').value;

        if (editingStaffId) {
            const staff = staffList.find(s => s.id === editingStaffId);
            Object.assign(staff, { name, role, status, email });
        } else {
            const newId = `#NV${String(staffList.length + 1).padStart(3, '0')}`;
            staffList.push({ id: newId, name, role, status, email });
        }

        renderStaff();
        closeStaffModal();
    });

    window.editStaff = (id) => {
        editingStaffId = id;
        const staff = staffList.find(s => s.id === id);
        if (!staff) return;
        modalTitle.textContent = 'Sửa nhân viên';
        document.getElementById('staffName').value = staff.name;
        document.getElementById('staffRole').value = staff.role;
        document.getElementById('staffStatus').value = staff.status;
        document.getElementById('staffEmail').value = staff.email;
        staffModal.classList.remove('hidden');
    };

    window.deleteStaff = (id) => {
        if (confirm("Bạn có chắc chắn muốn xóa nhân viên này?")) {
            staffList = staffList.filter(s => s.id !== id);
            renderStaff();
        }
    };

    // Initial render
    renderStaff();
});
</script>


</body>
</html>
