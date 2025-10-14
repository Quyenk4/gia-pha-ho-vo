@extends('layouts.app')

@section('title','Hồ sơ Người dùng (Profile)')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    
    <h1 class="text-4xl font-extrabold mb-8 text-gray-800 flex items-center border-b pb-3">
        👤 Thông tin Tài khoản
    </h1>

    {{-- Khối chính - Thẻ Profile --}}
    <div class="bg-white p-8 rounded-2xl shadow-2xl border-t-8 border-indigo-500">
        
        <div class="flex flex-col sm:flex-row items-center sm:items-start space-y-6 sm:space-y-0 sm:space-x-8 pb-6 border-b border-gray-100">
            
            {{-- Ảnh đại diện --}}
            <div class="flex-shrink-0 relative">
                <img src="{{ $user['photo'] ?? '/images/default-avatar.png' }}" 
                     alt="{{ $user['name'] ?? 'Người dùng' }}"
                     class="w-32 h-32 object-cover rounded-full border-4 border-indigo-400 shadow-lg">
                {{-- Badge trạng thái (giả định) --}}
                <span class="absolute bottom-0 right-0 block h-6 w-6 rounded-full ring-2 ring-white bg-green-400" 
                      title="Trạng thái hoạt động"></span>
            </div>
            
            {{-- Thông tin cơ bản --}}
            <div class="text-center sm:text-left">
                <h2 class="text-3xl font-bold text-gray-900 mb-1">
                    {{ $user['name'] ?? 'Võ Văn Quyền' }}
                </h2>
                <p class="text-lg text-gray-500 mb-2">
                    📧 {{ $user['email'] ?? 'quyen@example.com' }}
                </p>
                <div class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-indigo-100 text-indigo-700">
                    <span class="font-medium">Quyền:</span> {{ $user['role'] ?? 'Quản trị' }}
                </div>
            </div>
        </div>

        {{-- Chi tiết thông tin khác (giả định) --}}
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-y-5 gap-x-10">
            
            {{-- Ngày tham gia --}}
            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                <span class="text-xl text-indigo-600">📅</span>
                <div>
                    <div class="text-sm font-semibold text-gray-500">Ngày tham gia</div>
                    <div class="text-base font-medium text-gray-800">{{ $user['joined_date'] ?? '10/01/2023' }}</div>
                </div>
            </div>
            
            {{-- Lần đăng nhập cuối --}}
            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                <span class="text-xl text-indigo-600">⏱️</span>
                <div>
                    <div class="text-sm font-semibold text-gray-500">Đăng nhập cuối</div>
                    <div class="text-base font-medium text-gray-800">{{ $user['last_login'] ?? 'Vừa xong' }}</div>
                </div>
            </div>
        </div>

        {{-- Nút Hành động --}}
        <div class="mt-10 pt-6 border-t border-gray-200 flex justify-end space-x-4">
            <button type="button" 
                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-2 rounded-xl shadow-lg transition duration-300 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                Chỉnh sửa Hồ sơ
            </button>
            <button type="button" 
                    class="bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-2 rounded-xl shadow-lg transition duration-300 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6-6h6m-6 4h6m8-4a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Đổi mật khẩu
            </button>
        </div>
        
    </div>
</div>
@endsection