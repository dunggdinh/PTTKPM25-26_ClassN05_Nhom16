<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách nhân viên</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>
<body class="bg-gray-100 p-6">
    <div id="staff" class="section">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Danh sách nhân viên</h2>
                <p class="text-gray-600 mt-1">Quản lý thông tin và quyền hạn nhân viên</p>
            </div>
            <button class="gradient-bg text-white px-4 py-2 rounded-lg hover:opacity-90 transition-all duration-200" onclick="openAddStaffModal()">
                <i class="fas fa-plus mr-2"></i>Thêm nhân viên
            </button>
        </div>

        <!-- Ô thống kê -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-purple-500">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-crown text-purple-600"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-800">2</p>
                        <p class="text-sm text-gray-600">Admin</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-blue-500">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-shopping-cart text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-800">5</p>
                        <p class="text-sm text-gray-600">Order Manager</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-green-500">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-warehouse text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-800">3</p>
                        <p class="text-sm text-gray-600">Storekeeper</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-yellow-500">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-headset text-yellow-600"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-800">8</p>
                        <p class="text-sm text-gray-600">Support Staff</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bảng nhân viên -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-6 border-b">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                    <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4">
                        <div class="relative">
                            <input type="text" placeholder="Tìm kiếm nhân viên..." class="pl-10 pr-4 py-2 border rounded-lg w-full md:w-64" id="staffSearch">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <select class="border rounded-lg px-4 py-2" id="roleFilter">
                            <option value="">Tất cả chức vụ</option>
                            <option value="admin">Admin</option>
                            <option value="order-manager">Order Manager</option>
                            <option value="storekeeper">Storekeeper</option>
                            <option value="support">Support Staff</option>
                        </select>
                        <select class="border rounded-lg px-4 py-2" id="statusFilter">
                            <option value="">Tất cả trạng thái</option>
                            <option value="active">Hoạt động</option>
                            <option value="inactive">Không hoạt động</option>
                            <option value="suspended">Tạm khóa</option>
                        </select>
                    </div>
                    <div class="flex space-x-2">
                        <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
                            <i class="fas fa-download mr-2"></i>Xuất Excel
                        </button>
                        <button class="bg-blue-100 text-blue-700 px-4 py-2 rounded-lg hover:bg-blue-200 transition-colors">
                            <i class="fas fa-filter mr-2"></i>Bộ lọc
                        </button>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full" id="staffTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                <input type="checkbox" class="rounded" id="selectAll">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nhân viên</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Chức vụ</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Liên hệ</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap"><input type="checkbox" class="rounded"></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img class="h-8 w-8 rounded-full" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 32 32'%3E%3Ccircle cx='16' cy='16' r='16' fill='%23e0e0e0'/%3E%3Ctext x='16' y='21' text-anchor='middle' fill='%23616161' font-family='Arial' font-size='14' font-weight='bold'%3EA%3C/text%3E%3C/svg%3E" alt="">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Nguyễn Văn A</div>
                                        <div class="text-sm text-gray-500">ID: #NV001</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Admin</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"> Hoạt động </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                    <span class="text-gray-600">a.nguyen@email.com</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-indigo-600 hover:text-indigo-900">Sửa</button>
                                <button class="text-red-600 hover:text-red-900 ml-4">Xóa</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
