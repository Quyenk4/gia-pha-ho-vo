<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('title','Gia Phả Họ Võ')</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style> html { font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto; } .card{ border-radius: 12px; box-shadow: 0 10px 30px rgba(2,6,23,0.06);} </style>

  @stack('head')
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
  <!-- header -->
  <header class="bg-white shadow sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center gap-6">
          <a href="{{ route('home') }}" class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="w-10 h-10 rounded-full">
            <span class="text-2xl font-extrabold text-orange-500">Gia Phả</span>
          </a>

          <nav class="hidden md:flex space-x-4 text-gray-600">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-orange-500 font-semibold':'' }}">Trang chủ</a>
            <a href="{{ route('members.index') }}" class="{{ request()->routeIs('members.*') ? 'text-orange-500 font-semibold':'' }}">Thành viên</a>
            <a href="{{ route('tree.index') }}" class="{{ request()->routeIs('tree.*') ? 'text-orange-500 font-semibold':'' }}">Cây gia phả</a>
            <a href="{{ route('events.index') }}" class="{{ request()->routeIs('events.*') ? 'text-orange-500 font-semibold':'' }}">Sự kiện</a>
            <a href="{{ route('statistic.index') }}" class="{{ request()->routeIs('statistic.*') ? 'text-orange-500 font-semibold':'' }}">Thống kê</a>
          </nav>
        </div>

        <div class="flex items-center gap-4">
          <a href="{{ route('profile.index') }}" class="text-gray-600 hidden sm:inline">Xin chào, <strong>Võ Văn Quyền</strong></a>
          <a href="{{ route('login') }}" class="bg-red-500 text-white px-3 py-1 rounded-md">Đăng nhập</a>
        </div>
      </div>
    </div>
  </header>

  <main class="flex-grow">
    @yield('content')
  </main>

  <footer class="text-center text-sm text-gray-500 py-6">
    &copy; 2025 Hệ thống Quản lý Gia phả Họ Võ.
  </footer>

  @stack('scripts')
</body>
</html>
