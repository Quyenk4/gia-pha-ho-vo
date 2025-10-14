@extends('layouts.app')
@section('title','Đăng nhập')
@section('content')
<div class="min-h-[70vh] flex items-center justify-center">
  <div class="w-full max-w-md p-8">
    <div class="text-center mb-6">
      <img src="{{ asset('images/logo.png') }}" class="mx-auto w-20 h-20 rounded-full shadow">
      <h2 class="text-2xl font-bold mt-3">Đăng nhập – Gia Phả Họ Võ</h2>
      <p class="text-sm text-gray-500">Nhập thông tin để truy cập hệ thống</p>
    </div>

    <div class="bg-white p-6 rounded-xl card">
      <form action="#" method="POST">
        @csrf
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Email hoặc username</label>
          <input name="username" class="w-full border rounded p-2 mt-1" value="">
        </div>
        <div class="mb-4 relative">
          <label class="block text-sm font-medium text-gray-700">Mật khẩu</label>
          <input type="password" name="password" id="login-password" class="w-full border rounded p-2 mt-1">
          <button type="button" id="toggle-pass" class="absolute right-3 top-9 text-gray-400">hi/lo</button>
        </div>
        <div class="flex items-center justify-between mb-4">
          <label class="inline-flex items-center"><input type="checkbox" class="mr-2"> Ghi nhớ</label>
          <a href="#" class="text-sm text-blue-600">Quên mật khẩu?</a>
        </div>
        <button class="w-full bg-orange-500 text-white py-2 rounded">Đăng nhập</button>
      </form>
    </div>
  </div>
</div>

@push('scripts')
<script>
  document.getElementById('toggle-pass')?.addEventListener('click', function(){
    const p = document.getElementById('login-password');
    p.type = p.type === 'password' ? 'text' : 'password';
  });
</script>
@endpush
@endsection
