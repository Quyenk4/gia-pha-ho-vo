@extends('layouts.app')

@section('title','Trang chủ Gia Phả - Họ Võ')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Phần Banner Chính (Đã thêm Image & Shadow) --}}
    <div class="mt-6 card p-8 bg-cover bg-center text-white rounded-2xl shadow-2xl transition duration-500 ease-in-out transform hover:scale-[1.01]" 
         style="background-image: url('{{ asset('images/vietnamese-traditional-pattern.jpg') }}'); background-color: #D97706; position: relative;">
        
        {{-- Lớp phủ mờ để chữ dễ đọc hơn --}}
        <div class="absolute inset-0 bg-gradient-to-r from-orange-600/90 to-red-600/80 rounded-2xl"></div>
        
        <div class="relative z-10">
            <p class="text-sm uppercase tracking-widest font-medium text-orange-200">Tổng quan tộc họ</p>
            <h1 class="text-4xl font-extrabold mt-2 tracking-tight drop-shadow-lg">
                Gia Phả Họ Võ (Chi III - Thành Phố Huế) 📜
            </h1>
            <p class="mt-3 text-lg text-orange-100 italic">
                Nơi lưu giữ và kết nối các thế hệ, vẹn tròn chữ hiếu.
            </p>
        </div>
        
    </div>

    {{--- ---}}

    <h2 class="text-3xl font-bold mt-12 mb-6 text-gray-800 border-b pb-2">📊 Thống kê nhanh</h2>

    {{-- Khối Thống Kê Nhanh (Đã thêm Hover & Shadow) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        {{-- Thẻ Tổng thành viên --}}
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:-translate-y-1 flex items-center border-t-4 border-orange-500">
            <div class="mr-4 p-3 bg-orange-100 rounded-full flex-shrink-0">
                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m12 0h-7M7 20v-2a3 3 0 013-3h10a3 3 0 013 3v2M4 16v-2a3 3 0 013-3h10a3 3 0 003 3v2M12 14V8"/></svg>
            </div>
            <div>
                <div class="text-md text-gray-500 font-medium">Tổng số thành viên</div>
                <div class="text-3xl font-extrabold text-orange-700 mt-1">{{ $stats['total_members'] ?? '—' }}</div>
            </div>
        </div>

        {{-- Thẻ Thế hệ --}}
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:-translate-y-1 flex items-center border-t-4 border-green-500">
            <div class="mr-4 p-3 bg-green-100 rounded-full flex-shrink-0">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1M4 12V8m0 4l-4-4m4 4l4-4m4-4h4m-4 0v4m-4-4h-4"/></svg>
            </div>
            <div>
                <div class="text-md text-gray-500 font-medium">Đang ở thế hệ</div>
                <div class="text-3xl font-extrabold text-green-700 mt-1">{{ $stats['generation'] ?? '—' }}</div>
            </div>
        </div>

        {{-- Thẻ Sự kiện --}}
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:-translate-y-1 flex items-center border-t-4 border-blue-500">
            <div class="mr-4 p-3 bg-blue-100 rounded-full flex-shrink-0">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h.01M7 21h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v12a2 2 0 002 2zm2-7v7m4-7v7"/></svg>
            </div>
            <div>
                <div class="text-md text-gray-500 font-medium">Sự kiện sắp tới</div>
                <div class="text-3xl font-extrabold text-blue-700 mt-1">{{ $stats['upcoming_events'] ?? 0 }}</div>
            </div>
        </div>

        {{-- Thẻ Sinh nhật --}}
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:-translate-y-1 flex items-center border-t-4 border-purple-500">
            <div class="mr-4 p-3 bg-purple-100 rounded-full flex-shrink-0">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.524 0-1.042.122-1.54-.029V15.546zm0 0v-4.308m0 4.308l-1.54-.029M3 15.546c.524 0 1.042.122 1.54-.029V15.546zm0 0v-4.308m0 4.308l1.54-.029M12 21a9 9 0 110-18 9 9 0 010 18zm0-16a7 7 0 100 14 7 7 0 000-14zM12 8v8m-4-4h8"/></svg>
            </div>
            <div>
                <div class="text-md text-gray-500 font-medium">Sinh nhật tháng này</div>
                <div class="text-3xl font-extrabold text-purple-700 mt-1">{{ $stats['birthdays'] ?? 0 }}</div>
            </div>
        </div>
    </div>

    {{--- ---}}

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-12">
        
        {{-- Khối Chức Năng Nhanh (Đã thêm Biểu tượng & Hover) --}}
        <div class="bg-white p-6 rounded-xl shadow-lg h-full">
            <h3 class="text-xl font-bold mb-5 text-gray-800 border-b pb-2">⚡ Chức năng nhanh</h3>
            <ul class="space-y-4">
                <li class="group">
                    <a href="{{ route('members.index') }}" class="flex items-center p-2 rounded-lg transition duration-200 hover:bg-orange-50 hover:text-orange-600 font-medium">
                        <svg class="w-5 h-5 mr-3 text-orange-500 group-hover:text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m12 0h-7M7 20v-2a3 3 0 013-3h10a3 3 0 013 3v2M4 16v-2a3 3 0 013-3h10a3 3 0 003 3v2M12 14V8"/></svg>
                        Quản lý **Thành viên**
                    </a>
                </li>
                <li class="group">
                    <a href="{{ route('tree.index') }}" class="flex items-center p-2 rounded-lg transition duration-200 hover:bg-green-50 hover:text-green-600 font-medium">
                        <svg class="w-5 h-5 mr-3 text-green-500 group-hover:text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
                        Xem **Cây Gia phả**
                    </a>
                </li>
                <li class="group">
                    <a href="{{ route('events.index') }}" class="flex items-center p-2 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600 font-medium">
                        <svg class="w-5 h-5 mr-3 text-blue-500 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h.01M7 21h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Quản lý **Sự kiện**
                    </a>
                </li>
                <li class="group">
                    <a href="{{ route('statistic.index') }}" class="flex items-center p-2 rounded-lg transition duration-200 hover:bg-indigo-50 hover:text-indigo-600 font-medium">
                        <svg class="w-5 h-5 mr-3 text-indigo-500 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0h6m-4 0a2 2 0 002-2v-6m-4 0v6m0 0H5"/></svg>
                        Xem **Thống Kê**
                    </a>
                </li>
            </ul>
        </div>

        <div class="lg:col-span-2 space-y-8">
            
            {{-- Khối Hoạt Động Gần Đây (Đã thêm Shadow) --}}
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-xl font-bold mb-5 text-gray-800 border-b pb-2">⏰ Hoạt động gần đây</h3>
                <ul class="divide-y divide-gray-100">
                    @forelse($activities as $a)
                        <li class="py-3 flex justify-between items-center group hover:bg-gray-50 rounded-md px-2 transition duration-150">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                                <div>
                                    <div class="font-semibold text-gray-700">{{ $a['action'] }}</div>
                                    <div class="text-xs text-gray-500 italic">{{ $a['detail'] }} — **{{ $a['by'] }}**</div>
                                </div>
                            </div>
                            <div class="text-xs text-gray-400 font-light">{{ $a['time'] }}</div>
                        </li>
                    @empty
                        <li class="py-3 text-gray-500 italic text-center">Chưa có hoạt động nào gần đây.</li>
                    @endforelse
                </ul>
                <div class="text-right mt-4 pt-3 border-t border-gray-100">
                    <a href="{{ route('activities.index') }}" class="text-sm font-medium text-orange-600 hover:text-orange-700 transition duration-150">Xem tất cả hoạt động &rarr;</a>
                </div>
            </div>

            {{-- Khối Sự kiện Sắp Tới (Đã thêm Biểu tượng & Shadow) --}}
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-xl font-bold mb-5 text-gray-800 border-b pb-2">📅 Sự kiện sắp tới</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @forelse($events as $e)
                        <div class="p-4 rounded-lg bg-{{ $e['color'] }}-50 shadow-md border-l-4 border-{{ $e['color'] }}-500 transition duration-200 hover:shadow-lg">
                            <div class="font-bold text-{{ $e['color'] }}-700 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $e['title'] }}
                            </div>
                            <div class="text-sm text-{{ $e['color'] }}-600 mt-1 italic">{{ $e['date'] }}</div>
                        </div>
                    @empty
                        <div class="sm:col-span-2 text-center text-gray-500 italic p-4 bg-gray-50 rounded-lg">Không có sự kiện nào sắp diễn ra.</div>
                    @endforelse
                </div>
                <div class="text-center mt-6 pt-4 border-t border-gray-100">
                    <a href="{{ route('events.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 transition duration-150">Quản lý và tạo sự kiện &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection