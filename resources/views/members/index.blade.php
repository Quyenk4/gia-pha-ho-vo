@extends('layouts.app')

@section('title', 'Danh sách thành viên Gia phả')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
{{-- PHẦN 1: TIÊU ĐỀ & THANH CÔNG CỤ --}}
<h1 class="text-5xl font-extrabold mb-10 text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-600 border-b-4 border-orange-200 pb-3 flex items-center justify-center tracking-tight transition duration-500 hover:scale-[1.01] hover:shadow-lg rounded-md group">
    <span class="mr-3 text-4xl transform rotate-12 inline-block transition duration-500 group-hover:rotate-0">📜</span> 
    Danh sách thành viên Gia Phả
    <span class="ml-3 text-4xl transform -rotate-12 inline-block transition duration-500 group-hover:rotate-0">👨‍👩‍👧‍👦</span>
</h1>

<div class="flex flex-col sm:flex-row justify-between items-center mb-10 p-4 bg-white rounded-xl shadow-2xl border border-gray-100 sticky top-0 z-10 transition duration-500 hover:ring-2 hover:ring-orange-200">
    {{-- Bộ đếm thành viên --}}
    <p class="text-xl font-bold text-gray-700 mb-4 sm:mb-0">
        Tổng số thành viên:
        <span class="text-3xl font-extrabold text-orange-600 ml-2">{{ $members->total() }}</span>
    </p>
    
    {{-- Nút Thêm Thành Viên --}}
    <a href="{{ route('members.create') }}"
        class="w-full sm:w-auto bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white font-extrabold px-6 py-3 rounded-full shadow-2xl transition duration-500 ease-in-out transform hover:scale-105 hover:rotate-1 hover:ring-4 hover:ring-orange-300 active:scale-95 flex items-center justify-center group">
        <svg class="w-6 h-6 mr-2 transition duration-300 group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Thêm Thành Viên Mới ✨
    </a>
</div>

{{-- Nếu chưa có thành viên --}}
@if($members->isEmpty())
    <div class="text-center p-20 bg-gradient-to-br from-gray-50 to-white rounded-3xl border-4 border-dashed border-orange-300 mt-10 shadow-xl">
        <h3 class="mt-4 text-2xl font-extrabold text-gray-900">Danh sách trống trơn... 😢</h3>
        <p class="mt-2 text-md text-gray-600">Hãy bắt đầu hành trình lưu giữ gia phả bằng cách thêm thành viên đầu tiên!</p>
        <a href="{{ route('members.create') }}" 
           class="mt-5 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full shadow-lg text-white bg-orange-500 hover:bg-orange-600">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Thêm Thành Viên Ngay!
        </a>
    </div>
@else
    {{-- DANH SÁCH THÀNH VIÊN --}}
    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
        @foreach($members as $m)
            @php
                $is_male = ($m->Gender === 'Nam');
                $text_color = $is_male ? 'text-blue-600' : 'text-pink-600';
                $border_color = $is_male ? 'border-blue-500' : 'border-pink-500';
                $ring_color = $is_male ? 'ring-blue-400' : 'ring-pink-400';
                $shadow_color = $is_male ? 'shadow-blue-300/50' : 'shadow-pink-300/50';
                $avatar_url = $m->Avatar ? asset('images/members/' . $m->Avatar) : asset('images/default_avatar.png');
            @endphp

            <article class="group bg-white rounded-xl {{ $shadow_color }} hover:shadow-2xl transition duration-500 transform hover:-translate-y-2 overflow-hidden border-t-8 {{ $border_color }}">
                {{-- ẢNH + TÊN --}}
                <div class="p-4 pt-6 text-center border-b border-gray-100">
                    <img src="{{ $avatar_url }}" alt="{{ $m->FullName }}" 
                         class="w-24 h-24 object-cover rounded-full mx-auto mb-3 border-4 border-gray-200 shadow-md group-hover:ring-2 {{ $ring_color }}">
                    <h3 class="text-xl font-bold text-gray-800 truncate group-hover:{{ $text_color }}">
                        {{ $m->FullName }}
                    </h3>
                    <p class="text-sm font-semibold {{ $text_color }}">
                        {{ $is_male ? '💙 Nam' : '💖 Nữ' }}
                    </p>
                </div>

                {{-- THÔNG TIN PHỤ --}}
                <div class="p-3 bg-gray-50/70 border-b border-gray-100 text-sm text-gray-600">
                    <div class="flex justify-between">
                        <span>Thế hệ: <b>{{ $m->Generation ?? '?' }}</b></span>
                        <span>Nơi sinh: <b>{{ $m->PlaceOfBirth ?? 'Chưa rõ' }}</b></span>
                    </div>
                  
                </div>
{{-- QUAN HỆ GIA ĐÌNH --}}
<div class="p-3 bg-white border-t border-gray-100 text-xs text-gray-700 space-y-1">
    

    {{-- Hiển thị Vợ / Chồng --}}
    @if($m->Gender === 'Nam')
        @php
            $marriage = $m->marriagesAsHusband->first();
        @endphp
        <p><b>💍 Vợ:</b> {{ optional(optional($marriage)->wife)->FullName ?? 'Chưa rõ' }}</p>

    @elseif($m->Gender === 'Nữ')
        @php
            $marriage = $m->marriagesAsWife->first();
        @endphp
        <p><b>💍 Chồng:</b> {{ optional(optional($marriage)->husband)->FullName ?? 'Chưa rõ' }}</p>
    @endif
</div>


                {{-- SỰ KIỆN THAM GIA (nếu có) --}}
                @if($m->events && $m->events->count() > 0)
                    <div class="p-3 bg-orange-50 text-xs border-b border-orange-200">
                        <p class="font-bold text-orange-700 mb-1">Sự kiện tham gia:</p>
                        <ul class="list-disc list-inside text-gray-700 space-y-1">
                            @foreach($m->events as $event)
                                <li>{{ $event->EventName }} ({{ \Carbon\Carbon::parse($event->EventDate)->format('d/m/Y') }})</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- HÀNH ĐỘNG --}}
                <div class="p-3 flex justify-around bg-white">
                    <a href="{{ route('members.show', $m->PersonalID) }}" 
                       class="text-blue-600 hover:text-white bg-blue-100 hover:bg-blue-600 px-3 py-1 rounded-full text-sm font-semibold shadow-md transition">
                        Xem
                    </a>

                    <a href="{{ route('members.edit', $m->PersonalID) }}" 
                       class="text-green-600 hover:text-white bg-green-100 hover:bg-green-600 px-3 py-1 rounded-full text-sm font-semibold shadow-md transition">
                        Sửa
                    </a>

                    <form action="{{ route('members.destroy', $m->PersonalID) }}" method="POST" 
                          onsubmit="return confirm('⚠️ Xác nhận xóa {{ $m->FullName }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                            class="text-red-600 hover:text-white bg-red-100 hover:bg-red-600 px-3 py-1 rounded-full text-sm font-semibold shadow-md transition">
                            Xóa
                        </button>
                    </form>
                </div>
            </article>
        @endforeach
    </div>

    {{-- PHÂN TRANG --}}
    <div class="mt-12 mb-8 flex justify-center">
        {{ $members->links('pagination::tailwind') }}
    </div>
@endif

</div> @endsection