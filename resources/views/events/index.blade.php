@extends('layouts.app')

@section('title','Quản lý Sự kiện Gia Phả')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
        
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h2 class="text-3xl font-extrabold text-gray-800 flex items-center">
                📅 Lịch Sự Kiện Tộc Họ
            </h2>
            <a href="{{ route('events.create') }}" class="bg-orange-600 hover:bg-orange-700 text-white font-semibold px-4 py-2 rounded-xl shadow-lg transition duration-300 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Thêm Sự Kiện Mới
            </a>
        </div>

        {{-- Danh sách Sự kiện --}}
        <div class="space-y-4">
            @forelse($events as $ev)
                @php
                    // Thiết lập màu sắc và icon dựa trên loại sự kiện (Type)
                    $type = $ev['type'] ?? 'Khác';
                    $color = 'indigo';
                    $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h.01M7 21h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v12a2 2 0 002 2z" />'; // Calendar icon

                    if (stripos($type, 'Giỗ') !== false || stripos($type, 'Cúng') !== false) {
                        $color = 'red';
                        $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>'; // Clock icon
                    } elseif (stripos($type, 'Họp') !== false || stripos($type, 'Gặp mặt') !== false) {
                        $color = 'blue';
                        $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m12 0h-7M7 20v-2a3 3 0 013-3h10a3 3 0 013 3v2M4 16v-2a3 3 0 013-3h10a3 3 0 003 3v2M12 14V8"/>'; // Users icon
                    } elseif (stripos($type, 'Sinh nhật') !== false) {
                        $color = 'pink';
                        $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.524 0-1.042.122-1.54-.029V15.546zM21 21v-4.308m0 0l-1.54-.029M3 15.546c.524 0 1.042.122 1.54-.029V15.546zM3 21v-4.308m0 0l1.54-.029M12 21a9 9 0 110-18 9 9 0 010 18zm0-16a7 7 0 100 14 7 7 0 000-14zM12 8v8m-4-4h8"/>'; // Gift icon
                    }
                @endphp

                {{-- Thẻ Sự kiện (Đã thêm màu sắc, icon và shadow) --}}
                <div class="flex items-center p-4 bg-{{ $color }}-50 rounded-xl shadow-md border-l-4 border-{{ $color }}-500 transition duration-300 hover:shadow-lg hover:bg-{{ $color }}-100">
                    
                    {{-- Icon Lớn --}}
                    <div class="flex-shrink-0 mr-4 p-3 bg-{{ $color }}-200 rounded-full">
                        <svg class="w-6 h-6 text-{{ $color }}-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $icon !!}</svg>
                    </div>

                    {{-- Nội dung Sự kiện --}}
                    <div class="flex-1 min-w-0">
                        <div class="font-extrabold text-lg text-{{ $color }}-800 truncate">{{ $ev['title'] }}</div>
                        <div class="text-sm text-gray-600 mt-1 flex items-center space-x-3">
                            <span class="font-medium text-{{ $color }}-600">🗓 {{ $ev['date'] }}</span>
                            <span class="text-gray-500">|</span>
                            <span>📍 {{ $ev['place'] ?? 'Chưa có địa điểm' }}</span>
                            <span class="text-gray-500">|</span>
                            <span class="font-medium text-gray-700">{{ $type }}</span>
                        </div>
                        @if(!empty($ev['note']))
                            <div class="text-sm text-gray-500 italic mt-1 truncate">{{ $ev['note'] }}</div>
                        @endif
                    </div>

                    {{-- Hành động --}}
                    <div class="ml-4 flex-shrink-0">
                        <a href="{{ route('events.show', $ev['id'] ?? 1) }}" 
                           class="inline-flex items-center text-sm font-semibold text-{{ $color }}-600 hover:text-{{ $color }}-700 bg-white px-3 py-1 rounded-lg border border-gray-200 transition duration-150 shadow-sm hover:shadow-md">
                            Chi tiết
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>
            @empty
                {{-- Trạng thái trống --}}
                <div class="text-center p-12 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h.01M7 21h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">Không có sự kiện nào</h3>
                    <p class="mt-1 text-sm text-gray-500">Bắt đầu bằng cách thêm một sự kiện mới để quản lý.</p>
                    <div class="mt-6">
                        <a href="{{ route('events.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700">
                            + Thêm Sự Kiện
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection