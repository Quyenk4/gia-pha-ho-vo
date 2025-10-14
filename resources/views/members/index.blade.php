@extends('layouts.app')

@section('title', 'Danh sách thành viên Tộc Họ')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <h1 class="text-4xl font-extrabold mb-8 text-gray-800 border-b pb-2 flex items-center">
        👨‍👩‍👧‍👦 Danh sách thành viên Gia Phả
    </h1>
    
    <div class="flex justify-between items-center mb-6">
        <p class="text-lg font-semibold text-gray-600">
            <span class="text-orange-600">{{ count($members ?? []) }}</span> thành viên
        </p>
        <a href="{{ route('members.create') }}" 
           class="bg-orange-600 hover:bg-orange-700 text-white font-semibold px-4 py-2 rounded-xl shadow-lg transition duration-300 flex items-center">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Thêm Thành Viên Mới
        </a>
    </div>

    @if(empty($members))
        {{-- Trạng thái danh sách rỗng (Empty State) --}}
        <div class="text-center p-12 bg-gray-50 rounded-xl border border-dashed border-gray-300 mt-10">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m12 0h-7M7 20v-2a3 3 0 013-3h10a3 3 0 013 3v2M4 16v-2a3 3 0 013-3h10a3 3 0 003 3v2M12 14V8"/></svg>
            <h3 class="mt-2 text-lg font-medium text-gray-900">Danh sách trống</h3>
            <p class="mt-1 text-sm text-gray-500">Bạn chưa thêm thành viên nào vào gia phả này.</p>
        </div>
    @else
        {{-- Danh sách Thành viên (Dạng Card lưới) --}}
        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
            @foreach($members as $m)
                @php
                    // Thiết lập màu sắc theo giới tính để thẻ trực quan hơn
                    $is_male = (stripos($m['gender'] ?? '', 'Nam') !== false) || (stripos($m['gender'] ?? '', 'male') !== false);
                    $color = $is_male ? 'blue' : 'pink';
                @endphp
                
                <div class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 overflow-hidden border-t-4 border-{{ $color }}-400">
                    
                    {{-- Hình ảnh và Tên --}}
                    <div class="p-6">
                        <img src="{{ $m['photo'] ?? asset('images/default_avatar.png') }}" 
                             alt="{{ $m['name'] }}" 
                             class="w-24 h-24 object-cover rounded-full mx-auto mb-4 border-4 border-{{ $color }}-200 shadow-md">
                        
                        <h3 class="text-xl font-bold text-center text-gray-800 truncate">{{ $m['name'] }}</h3>
                        <p class="text-sm font-medium text-{{ $color }}-600 text-center mt-1">
                            @if ($is_male) 
                                👨 Nam
                            @else
                                👩 Nữ
                            @endif
                        </p>
                    </div>

                    {{-- Thông tin phụ và nút hành động --}}
                    <div class="bg-gray-50 p-4 border-t border-gray-100">
                        <p class="text-xs text-gray-500 text-center">
                            Thế hệ: <span class="font-semibold text-gray-700">{{ $m['generation'] ?? '?' }}</span> | 
                            Chi nhánh: <span class="font-semibold text-gray-700">{{ $m['branch'] ?? 'Chưa rõ' }}</span>
                        </p>
                        
                        <div class="mt-3 flex justify-center space-x-3">
                            <a href="{{ url('/members/'.$m['id']) }}" 
                               class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition duration-150 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                Xem
                            </a>
                            <a href="{{ url('/members/'.$m['id'].'/edit') }}" 
                               class="text-sm font-semibold text-green-600 hover:text-green-800 transition duration-150 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-9-1.414l6.364-6.364m-4.243 4.243L19 7m-6 4l6.364-6.364"/></svg>
                                Sửa
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection