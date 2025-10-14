@extends('layouts.app')

@section('title','Thống kê Tổng quan')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    
    <h1 class="text-4xl font-extrabold mb-8 text-gray-800 flex items-center border-b pb-3">
        📈 Thống kê Gia phả Tổng quan
    </h1>

    <div class="bg-white p-8 rounded-2xl shadow-2xl border border-gray-100">
        
        <h2 class="text-3xl font-bold mb-6 text-indigo-700 text-center border-b pb-3">
            Dữ liệu Gia tộc Họ Võ
        </h2>

        {{-- Khối 1: Thống kê Số lượng (Tổng quan & Giới tính) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            
            {{-- Tổng thành viên --}}
            <div class="p-5 rounded-xl shadow-lg bg-indigo-600 text-white flex flex-col items-center justify-center transform hover:scale-105 transition duration-300">
                <h3 class="text-lg font-semibold mb-1 opacity-90">Tổng số Thành viên</h3>
                <p class="text-5xl font-extrabold">{{ $stats['total_members'] ?? array_sum(array_column($stats ?? [], 'count')) }}</p>
                <span class="mt-1 text-sm opacity-80">người đã ghi nhận</span>
            </div>

            {{-- Tỷ lệ Nam --}}
            <div class="p-5 rounded-xl shadow-md bg-blue-100 border-l-4 border-blue-600">
                <div class="flex items-center space-x-3 mb-2">
                    <span class="text-3xl text-blue-600">👨</span>
                    <h4 class="text-xl font-bold text-blue-800">Nam giới</h4>
                </div>
                <p class="text-3xl font-extrabold text-blue-700">{{ $stats['male'] ?? 0 }}</p>
                <p class="text-sm text-gray-600 mt-1">
                    Chiếm {{ number_format(($stats['male'] ?? 0) / (($stats['total_members'] ?? 1) ?: 1) * 100, 1) }}%
                </p>
            </div>

            {{-- Tỷ lệ Nữ --}}
            <div class="p-5 rounded-xl shadow-md bg-pink-100 border-l-4 border-pink-600">
                <div class="flex items-center space-x-3 mb-2">
                    <span class="text-3xl text-pink-600">👩</span>
                    <h4 class="text-xl font-bold text-pink-800">Nữ giới</h4>
                </div>
                <p class="text-3xl font-extrabold text-pink-700">{{ $stats['female'] ?? 0 }}</p>
                <p class="text-sm text-gray-600 mt-1">
                    Chiếm {{ number_format(($stats['female'] ?? 0) / (($stats['total_members'] ?? 1) ?: 1) * 100, 1) }}%
                </p>
            </div>
        </div>

        {{-- Khối 2: Phân bố theo Thế hệ --}}
        <h3 class="text-2xl font-bold mb-4 text-gray-800 border-b pb-2 flex items-center">
            🌱 Phân bố Thành viên theo Thế hệ
        </h3>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($stats['by_generation'] ?? [] as $gen => $count)
                <div class="p-4 bg-green-50 rounded-xl border border-green-200 shadow-sm flex justify-between items-center hover:bg-green-100 transition">
                    <span class="text-lg font-semibold text-green-700">Thế hệ {{ $gen }}</span>
                    <span class="text-2xl font-extrabold text-gray-800">{{ $count }}</span>
                </div>
            @empty
                <p class="col-span-3 text-gray-500 italic p-4 bg-gray-50 rounded-lg">
                    Chưa có dữ liệu phân bố theo thế hệ.
                </p>
            @endforelse
        </div>
        
        {{-- Khối 3: Thống kê khác (Ví dụ: Sự kiện) --}}
        @if(isset($stats['total_events']))
        <div class="mt-10 pt-6 border-t border-gray-200">
            <h3 class="text-2xl font-bold mb-4 text-gray-800 border-b pb-2 flex items-center">
                📅 Thống kê Sự kiện & Hoạt động
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="p-4 bg-yellow-50 rounded-xl border-l-4 border-yellow-500 shadow-md">
                    <p class="text-sm font-semibold text-yellow-700">Tổng số Sự kiện</p>
                    <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ $stats['total_events'] ?? 0 }}</p>
                </div>
                
                {{-- Giả định có thống kê sự kiện đã tổ chức --}}
                <div class="p-4 bg-red-50 rounded-xl border-l-4 border-red-500 shadow-md">
                    <p class="text-sm font-semibold text-red-700">Lễ Giỗ/Cúng (Mẫu)</p>
                    <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ $stats['funeral_events'] ?? 0 }}</p>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection