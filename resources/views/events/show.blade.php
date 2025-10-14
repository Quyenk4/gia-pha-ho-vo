@extends('layouts.app')

@section('title', 'Chi tiết sự kiện')

@section('content')
@php
    // Thiết lập màu sắc và icon chính dựa trên loại sự kiện (Type)
    $type = $event['type'] ?? 'Lễ giỗ';
    $main_color = 'purple';
    if (stripos($type, 'Giỗ') !== false || stripos($type, 'Cúng') !== false) {
        $main_color = 'red'; // Tông ấm cho sự kiện tưởng niệm
    } elseif (stripos($type, 'Họp') !== false || stripos($type, 'Gặp mặt') !== false) {
        $main_color = 'blue'; // Tông lạnh cho sự kiện tổ chức
    }
@endphp

<div class="max-w-6xl mx-auto px-4 py-10">
    
    {{-- Khối chính - Thẻ Chi tiết Sự kiện --}}
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border-t-8 border-{{ $main_color }}-500">
        
        {{-- Ảnh Header --}}
        <img src="{{ $event['image'] ?? 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1200&q=60' }}" 
             alt="{{ $event['title'] ?? 'Sự kiện' }}"
             class="w-full h-72 object-cover">

        <div class="p-8">
            
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4 drop-shadow-sm">
                {{ $event['title'] ?? 'Lễ giỗ Tổ họ Võ Huế' }}
            </h1>
            
            {{-- Khối thông tin nhanh (Mini-cards) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8 pt-2 border-b pb-4">
                
                {{-- Ngày tổ chức --}}
                <div class="p-4 bg-{{ $main_color }}-50 rounded-xl border border-{{ $main_color }}-200 flex items-center space-x-3">
                    <span class="text-2xl text-{{ $main_color }}-600">📅</span>
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Ngày tổ chức</p>
                        <p class="text-lg font-bold text-gray-800">{{ $event['date'] ?? '14/10/2025' }}</p>
                    </div>
                </div>

                {{-- Địa điểm --}}
                <div class="p-4 bg-{{ $main_color }}-50 rounded-xl border border-{{ $main_color }}-200 flex items-center space-x-3 md:col-span-2">
                    <span class="text-2xl text-{{ $main_color }}-600">📍</span>
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Địa điểm</p>
                        <p class="text-lg font-bold text-gray-800">{{ $event['location'] ?? 'Nhà thờ họ Võ – Thừa Thiên Huế' }}</p>
                    </div>
                </div>
            </div>
            
            {{-- Nội dung sự kiện --}}
            <div class="pt-2">
                <h2 class="text-2xl font-bold mb-3 text-gray-800 border-b pb-1 flex items-center">
                    📝 Nội dung sự kiện
                </h2>
                <div class="text-gray-700 leading-relaxed bg-gray-50 p-4 rounded-xl border border-gray-200">
                    <p>
                        {{ $event['description'] ?? 'Lễ giỗ Tổ nhằm tưởng nhớ công ơn tổ tiên họ Võ, quy tụ con cháu trong và ngoài tỉnh về tham dự. 
                        Hoạt động bao gồm dâng hương, phát biểu của trưởng tộc, ghi công đức và giao lưu họ hàng.' }}
                    </p>
                </div>
            </div>

            {{-- Thành viên tham dự --}}
            <div class="mt-8 pt-4 border-t border-gray-200">
                <h2 class="text-2xl font-bold mb-3 text-gray-800 border-b pb-1 flex items-center">
                    👥 Thành viên tham dự (mẫu)
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <ul class="list-none space-y-2">
                        <li class="p-2 bg-yellow-50 rounded-lg border-l-4 border-yellow-400 font-medium text-gray-700">⭐ Võ Văn Hùng – Trưởng tộc</li>
                        <li class="p-2 bg-yellow-50 rounded-lg border-l-4 border-yellow-400 font-medium text-gray-700">🌱 Võ Thị Thu – Chi họ Đà Nẵng</li>
                    </ul>
                    <ul class="list-none space-y-2">
                        <li class="p-2 bg-yellow-50 rounded-lg border-l-4 border-yellow-400 font-medium text-gray-700">👶 Võ Minh Quân – Thế hệ thứ 8</li>
                        <li class="p-2 bg-yellow-50 rounded-lg border-l-4 border-yellow-400 font-medium text-gray-700">... và nhiều thành viên khác</li>
                    </ul>
                </div>
            </div>

            {{-- Nút Hành động --}}
            <div class="mt-10 pt-6 border-t border-gray-200 flex justify-end">
                <a href="{{ route('events.index') }}" 
                   class="bg-{{ $main_color }}-600 hover:bg-{{ $main_color }}-700 text-white font-semibold px-6 py-2 rounded-xl shadow-lg transition duration-300 flex items-center">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/></svg>
                    Quay lại danh sách
                </a>
            </div>
            
        </div>
    </div>
</div>
@endsection