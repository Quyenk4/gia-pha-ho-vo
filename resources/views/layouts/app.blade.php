<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Gia Phả Họ Võ')</title>


  <script src="https://cdn.tailwindcss.com"></script>


  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">


  <style>
    html {
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto;
    }

    .card {
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(2, 6, 23, 0.06);
    }
  </style>

  @stack('head')
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

  <!-- 🌐 HEADER -->
  <header class="bg-white shadow sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <!-- Logo + Menu -->
        <div class="flex items-center gap-6">
          <a href="{{ route('home') }}" class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Gia Phả" class="w-10 h-10 rounded-full">
            <span class="text-2xl font-extrabold text-orange-500">Gia Phả</span>
          </a>

          <!-- Menu desktop -->
          <nav class="hidden md:flex space-x-6 text-gray-600 font-medium">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-orange-600 font-semibold' : 'hover:text-orange-500' }}">Trang chủ</a>
            <a href="{{ route('members.index') }}" class="{{ request()->routeIs('members.*') ? 'text-orange-600 font-semibold' : 'hover:text-orange-500' }}">Thành viên</a>
            <a href="{{ route('tree.index') }}" class="{{ request()->routeIs('tree.*') ? 'text-orange-600 font-semibold' : 'hover:text-orange-500' }}">Cây gia phả</a>
            <a href="{{ route('events.index') }}" class="{{ request()->routeIs('events.*') ? 'text-orange-600 font-semibold' : 'hover:text-orange-500' }}">Sự kiện</a>
            <a href="{{ route('statistic.index') }}" class="{{ request()->routeIs('statistic.*') ? 'text-orange-600 font-semibold' : 'hover:text-orange-500' }}">Thống kê</a>
          </nav>
        </div>

        <!-- User + Login -->
        <div class="flex items-center gap-4">
          @auth
          <a href="{{ route('profile.index') }}" class="text-gray-600 hidden sm:inline">Xin chào, <strong>{{ Auth::user()->name }}</strong></a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition">Đăng xuất</button>
          </form>
          @else
  <div class="flex gap-3">
    <a href="{{ route('login') }}"
      class="bg-orange-500 text-white px-3 py-1 rounded-md hover:bg-orange-600 transition">
      Đăng nhập
    </a>
    <a href="{{ route('register') }}"
      class="border border-orange-500 text-orange-600 px-3 py-1 rounded-md hover:bg-orange-500 hover:text-white transition">
      Đăng ký
    </a>
  </div>
@endauth

        </div>

        <!-- Nút mobile -->
        <button id="mobile-menu-btn" class="md:hidden text-gray-700 focus:outline-none">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Menu mobile -->
    <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-200">
      <nav class="px-4 py-3 space-y-2 text-gray-700 font-medium">
        <a href="{{ route('home') }}" class="block {{ request()->routeIs('home') ? 'text-orange-600 font-semibold' : 'hover:text-orange-500' }}">Trang chủ</a>
        <a href="{{ route('members.index') }}" class="block {{ request()->routeIs('members.*') ? 'text-orange-600 font-semibold' : 'hover:text-orange-500' }}">Thành viên</a>
        <a href="{{ route('tree.index') }}" class="block {{ request()->routeIs('tree.*') ? 'text-orange-600 font-semibold' : 'hover:text-orange-500' }}">Cây gia phả</a>
        <a href="{{ route('events.index') }}" class="block {{ request()->routeIs('events.*') ? 'text-orange-600 font-semibold' : 'hover:text-orange-500' }}">Sự kiện</a>
        <a href="{{ route('statistic.index') }}" class="block {{ request()->routeIs('statistic.*') ? 'text-orange-600 font-semibold' : 'hover:text-orange-500' }}">Thống kê</a>
        @auth
        <a href="{{ route('profile.index') }}" class="text-gray-600 hidden sm:inline">
          Xin chào, <strong>{{ Auth::user()->name }}</strong>
        </a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition">Đăng xuất</button>
        </form>
        @else
        <div class="flex gap-3">
          <a href="{{ route('login') }}"
            class="bg-orange-500 text-white px-3 py-1 rounded-md hover:bg-orange-600 transition">
            Đăng nhập
          </a>
          <a href="{{ route('register') }}"
            class="border border-orange-500 text-orange-600 px-3 py-1 rounded-md hover:bg-orange-500 hover:text-white transition">
            Đăng ký
          </a>
        </div>
        @endauth

      </nav>
    </div>
  </header>

  <!-- 📄 MAIN CONTENT -->
  <main class="flex-grow">
    @yield('content')
  </main>

  <!-- ⚙️ FOOTER -->
  <footer class="text-center text-sm text-gray-500 py-6 border-t mt-10">
    &copy; {{ date('Y') }} Hệ thống Quản lý Gia phả Họ Võ. All rights reserved.
  </footer>

  <!-- 📜 Script -->
  <script>
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    btn?.addEventListener('click', () => menu.classList.toggle('hidden'));
  </script>

  @stack('scripts')
</body>

</html>