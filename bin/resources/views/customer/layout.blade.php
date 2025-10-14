<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Hệ thống Quản lý Cửa hàng Điện tử</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>
<body class="bg-gray-50">

  @include('partials.header')
  <div class="flex pt-16 min-h-screen">
    @include('partials.sidebar')
    <main class="flex-1 p-6 animate-fade-in">
      @yield('content')
    </main>
  </div>

  <div id="toast" class="fixed right-6 bottom-6 bg-black text-white px-4 py-2 rounded opacity-0 pointer-events-none transition-opacity">...</div>

  <script src="{{ url('js/admin.js') }}"></script>
</body>
</html>
<header class="gradient-bg text-white shadow-lg fixed w-full top-0 z-50">
  <div class="flex items-center justify-between px-6 py-4">
    <div class="flex items-center space-x-4">
      <i class="fas fa-store text-2xl"></i>
      <h1 class="text-xl font-bold">Thiết bị điện tử</h1>
    </div>
    <div class="flex items-center space-x-4">
      <button class="bg-white text-blue-600 px-3 py-1 rounded" onclick="showSection('store_home')">Xem cửa hàng</button>
      <div class="flex items-center space-x-2">
        <img src="data:image/svg+xml,... (avatar svg) ..." alt="Admin" class="w-8 h-8 rounded-full">
        <span class="font-medium">User</span>
      </div>
    </div>
  </div>
</header>
<aside class="w-72 bg-white shadow-lg h-screen sticky top-16 overflow-y-auto z-40">
  <nav class="mt-6">
    <div class="px-4 mb-4"><h2 class="text-gray-600 text-sm font-semibold uppercase">Quản lý</h2></div>

    <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700" onclick="showSection('dashboard')">
      <i class="fas fa-tachometer-alt mr-3"></i><span>Dashboard</span>
    </a>

    <div class="px-4 mt-6 mb-2">
      <h3 class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Cửa hàng (Khách hàng)</h3>
    </div>
    <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700" onclick="showSection('store_home')">
      <i class="fas fa-home mr-3"></i><span>Trang chủ</span>
    </a>
    <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700" onclick="showSection('store_products')">
      <i class="fas fa-shopping-bag mr-3"></i><span>Sản phẩm</span>
    </a>
    <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700" onclick="showSection('cart')">
      <i class="fas fa-shopping-cart mr-3"></i><span>Giỏ hàng</span>
    </a>
    <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700" onclick="showSection('orders')">
      <i class="fas fa-box-open mr-3"></i><span>Đơn hàng của tôi</span>
    </a>
    <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700" onclick="showSection('profile')">
      <i class="fas fa-user mr-3"></i><span>Tài khoản</span>
    </a>
    <a href="#" class="sidebar-item flex items-center px-6 py-3 text-gray-700" onclick="showSection('support')">
      <i class="fas fa-headset mr-3"></i><span>Hỗ trợ</span>
    </a>
  </nav>
</aside>
