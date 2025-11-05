@extends('layouts.app')

@section('title', 'Đăng nhập')

@section('content')

{{-- Khung nền sáng, sử dụng Gradient nhẹ nhàng --}}
<div class="min-h-[100vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 
            bg-gradient-to-br from-white to-gray-100 dark:from-gray-100 dark:to-gray-200">
  <div class="w-full max-w-md space-y-10">
    {{-- Phần tiêu đề và logo --}}
    <div class="text-center">
      {{-- Logo --}}
      <div class="mx-auto w-24 h-24 rounded-full flex items-center justify-center 
                        bg-white shadow-xl p-1 border-4 border-white transform transition duration-500 hover:scale-[1.03]">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Gia Phả Họ Võ"
          class="w-full h-full rounded-full object-cover">
      </div>

      {{-- Tiêu đề --}}
      <h2 class="mt-8 text-3xl font-extrabold text-gray-800 tracking-tight">
        Chào mừng trở lại!
      </h2>
      <p class="mt-2 text-base text-gray-500 font-light">
        Đăng nhập để quản lý Gia Phả Họ Võ
      </p>
    </div>

    {{-- Khối Form Đăng Nhập Glassmorphism/Tối giản --}}
    <div class="p-10 rounded-2xl transition duration-500 ease-in-out
                    bg-white/70 backdrop-blur-md shadow-2xl border border-white transform hover:shadow-3xl-orange">

      <form class="space-y-6" action="{{ route('login.post') }}" method="POST">

        @csrf

        {{-- Trường Email/Username --}}
        <div class="group">
          <label for="email" class="block text-sm font-medium text-gray-600 mb-2">
            <i class="fas fa-envelope mr-2 text-orange-500"></i> Địa chỉ Email
          </label>
          <input id="email" name="email" type="email" autocomplete="email" required
            class="appearance-none relative block w-full px-4 py-3 border border-gray-300 bg-gray-50 text-gray-800 rounded-lg 
                    focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent 
                    transition duration-300 ease-in-out placeholder-gray-400"
            placeholder="Nhập email" value="{{ old('email') }}">
        </div>

        {{-- Trường Mật khẩu --}}
        <div class="relative group">
          <label for="login-password" class="block text-sm font-medium text-gray-600 mb-2">
            <i class="fas fa-key mr-2 text-orange-500"></i> Mật khẩu
          </label>
          <input id="login-password" name="password" type="password" autocomplete="current-password" required
            class="appearance-none relative block w-full px-4 py-3 pr-12 border border-gray-300 bg-gray-50 text-gray-800 rounded-lg 
                                focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent 
                                transition duration-300 ease-in-out placeholder-gray-400"
            placeholder="Nhập mật khẩu">

          {{-- Nút chuyển đổi ẩn/hiện mật khẩu --}}
          <button type="button" id="toggle-pass"
            class="absolute inset-y-0 right-0 top-6 bottom-0 flex items-center px-3 text-gray-400 hover:text-orange-600 focus:outline-none 
                                transition duration-200 ease-in-out"
            title="Hiện/Ẩn mật khẩu">
            <i class="fas fa-eye-slash text-xl" id="toggle-icon"></i>
          </button>
        </div>

        {{-- Ghi nhớ & Quên mật khẩu --}}
        <div class="flex items-center justify-between pt-2">
          <div class="flex items-center">
            <input id="remember-me" name="remember" type="checkbox"
              class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded cursor-pointer">
            <label for="remember-me" class="ml-2 block text-sm text-gray-600 select-none hover:text-gray-800 transition">
              Ghi nhớ
            </label>
          </div>

          <div class="text-sm">
            <a href="#"
              class="font-medium text-blue-600 hover:text-blue-700 transition duration-150 ease-in-out hover:underline">
              Quên mật khẩu?
            </a>
          </div>
        </div>

        {{-- Nút Đăng nhập Gradient Mềm --}}
        <div class="pt-2">
          <button type="submit"
            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-lg font-bold rounded-xl text-white 
                                bg-gradient-to-r from-orange-500 to-orange-600 
                                shadow-lg shadow-orange-500/50 hover:shadow-xl hover:shadow-orange-600/70
                                focus:outline-none focus:ring-4 focus:ring-orange-500 focus:ring-opacity-50
                                transition duration-300 ease-in-out transform hover:-translate-y-0.5 active:scale-[0.98]">

            <span class="absolute left-0 inset-y-0 flex items-center pl-4">
              <i class="fas fa-arrow-right-to-bracket h-5 w-5 text-white/80 group-hover:animate-wiggle" aria-hidden="true"></i>
            </span>
            ĐĂNG NHẬP
          </button>
        </div>
      </form>
    </div>

    {{-- Đăng ký (tùy chọn) --}}
    <div class="text-center">
      <p class="text-base text-gray-500">
        Bạn chưa có tài khoản?
        <a href="{{ route('register') }}"
          class="font-bold text-orange-600 hover:text-orange-500 transition hover:underline">
          Đăng ký ngay
        </a>
      </p>
    </div>

  </div>
</div>

@push('styles')
<style>
  /* Hiệu ứng bóng đổ nổi bật khi hover khối form */
  .hover\:shadow-3xl-orange:hover {
    box-shadow: 0 25px 50px -12px rgba(249, 115, 22, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.5);
    /* Shadow lớn màu cam nhạt */
  }

  /* Keyframes cho hiệu ứng rung/lắc nhẹ (Wiggle) */
  @keyframes wiggle {

    0%,
    100% {
      transform: rotate(0deg);
    }

    25% {
      transform: rotate(5deg);
    }

    75% {
      transform: rotate(-5deg);
    }
  }

  .group-hover\:animate-wiggle {
    animation: wiggle 0.3s ease-in-out;
  }

  /* Glassmorphism: Thêm sự mờ và trong suốt (Dùng Tailwind: bg-white/70 backdrop-blur-md) */
  /* Nếu muốn hiệu ứng mạnh hơn, có thể tùy chỉnh thêm tại đây */
</style>
@endpush

@push('scripts')
{{-- Cần có thư viện Font Awesome --}}
<script>
  document.getElementById('toggle-pass')?.addEventListener('click', function() {
    const passwordInput = document.getElementById('login-password');
    const toggleIcon = document.getElementById('toggle-icon');

    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      toggleIcon.classList.remove('fa-eye-slash');
      toggleIcon.classList.add('fa-eye');
      this.title = 'Ẩn mật khẩu';
    } else {
      passwordInput.type = 'password';
      toggleIcon.classList.remove('fa-eye');
      toggleIcon.classList.add('fa-eye-slash');
      this.title = 'Hiện mật khẩu';
    }
  });
</script>
@endpush
@endsection