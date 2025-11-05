@extends('layouts.app')

@section('title', 'Trang chủ Gia Phả - Họ Võ')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- 🌅 Banner Giới thiệu Tộc họ --}}
    <div class="relative p-10 rounded-3xl shadow-2xl bg-cover bg-center overflow-hidden transition-all duration-300 hover:shadow-3xl"
        style="background-image: url('{{ asset('images/vietnamese-traditional-pattern.jpg') }}');">
        <div class="absolute inset-0 bg-gradient-to-br from-orange-800/90 to-red-700/80 rounded-3xl"></div>

        <div class="relative z-10 text-white">
            <p class="text-sm uppercase tracking-widest font-semibold text-orange-200 opacity-90">Tổng quan tộc họ</p>
            <h1 class="text-5xl font-extrabold mt-3 tracking-tighter leading-tight drop-shadow-xl">
                Gia Phả Họ Võ (Chi III - TP. Huế) 📜
            </h1>
            <p class="mt-4 text-xl text-orange-100 italic max-w-2xl">
                Nơi lưu giữ và kết nối các thế hệ – vẹn tròn chữ hiếu, bền chặt tình thân.
            </p>
        </div>
    </div>

    ---

    {{-- 📊 Thống kê nhanh (Đã thay thế x-stat-card) --}}
    <h2 class="text-3xl font-extrabold mt-12 mb-6 text-gray-900">📊 Thống kê nhanh</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        {{-- 1. Thẻ Thành viên --}}
        <div class="bg-white p-6 rounded-xl shadow-lg border-b-4 border-orange-500 hover:shadow-xl transition duration-150">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium uppercase tracking-wider text-orange-600">Tổng số thành viên</p>
                    <p class="text-4xl font-extrabold text-gray-900 mt-1">
                        {{ $stats['total_members'] ?? '—' }}
                    </p>
                </div>
                <svg class="w-10 h-10 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h-7a4 4 0 01-4-4V7a4 4 0 014-4h7a4 4 0 014 4v9a4 4 0 01-4 4zm-2-7a2 2 0 100-4 2 2 0 000 4zm4 4v1m0-5V8m-4 11h.01M9 11h.01M5 19h1a2 2 0 002-2v-3a2 2 0 00-2-2H5" />
                </svg>
            </div>
        </div>

        {{-- 2. Thẻ Thế hệ --}}
        <div class="bg-white p-6 rounded-xl shadow-lg border-b-4 border-green-500 hover:shadow-xl transition duration-150">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium uppercase tracking-wider text-green-600">Đang ở thế hệ</p>
                    <p class="text-4xl font-extrabold text-gray-900 mt-1">
                        {{ $stats['generation'] ?? '—' }}
                    </p>
                </div>
                <svg class="w-10 h-10 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7L12 3 4 7l8 4 8-4zM4 17l8 4 8-4M4 12l8 4 8-4" />
                </svg>
            </div>
        </div>

        {{-- 3. Thẻ Sự kiện --}}
        <div class="bg-white p-6 rounded-xl shadow-lg border-b-4 border-blue-500 hover:shadow-xl transition duration-150">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium uppercase tracking-wider text-blue-600">Sự kiện sắp tới</p>
                    <p class="text-4xl font-extrabold text-gray-900 mt-1">
                        {{ $stats['upcoming_events'] ?? 0 }}
                    </p>
                </div>
                <svg class="w-10 h-10 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h.01M16 11h.01M4 21h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        </div>

        {{-- 4. Thẻ Sinh nhật --}}
        <div class="bg-white p-6 rounded-xl shadow-lg border-b-4 border-purple-500 hover:shadow-xl transition duration-150">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium uppercase tracking-wider text-purple-600">Sinh nhật tháng này</p>
                    <p class="text-4xl font-extrabold text-gray-900 mt-1">
                        {{ $stats['birthdays'] ?? 0 }}
                    </p>
                </div>
                <svg class="w-10 h-10 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0zM5.51 3.51a.75.75 0 01-.11-.47A2.25 2.25 0 017.5 1h9A2.25 2.25 0 0118.6 3.04a.75.75 0 01-.11.47l-1.92 1.92L12 7.5l-4.57-2.07L5.51 3.51z" />
                </svg>
            </div>
        </div>
    </div>

    ---

    {{-- ⚙️ Chức năng nhanh + Hoạt động + Sự kiện --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-12">

        {{-- ⚡ Chức năng nhanh (Đã thay thế x-quick-link) --}}
        <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100 h-fit">
            <h3 class="text-2xl font-bold mb-5 text-gray-800 border-b pb-3 border-orange-100">⚡ Chức năng nhanh</h3>
            <ul class="space-y-4">
                {{-- 1. Quản lý Thành viên --}}
                <a href="{{ route('members.index') }}" class="group flex items-center p-3 rounded-xl bg-orange-50 hover:bg-orange-100 transition duration-150">
                    <div class="w-8 h-8 rounded-full bg-orange-500 flex items-center justify-center mr-4">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h-7a4 4 0 01-4-4V7a4 4 0 014-4h7a4 4 0 014 4v9a4 4 0 01-4 4zm-2-7a2 2 0 100-4 2 2 0 000 4zm4 4v1m0-5V8m-4 11h.01M9 11h.01M5 19h1a2 2 0 002-2v-3a2 2 0 00-2-2H5" />
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-700 group-hover:text-orange-700">Quản lý Thành viên</span>
                    <span class="ml-auto text-orange-400 group-hover:translate-x-1 transition-transform">→</span>
                </a>

                {{-- 2. Thiết lập Quan hệ --}}
                <a href="{{ route('relationships.index') }}"
                    class="group flex items-center p-3 rounded-xl bg-rose-50 hover:bg-rose-100 transition duration-150">
                    <div class="w-8 h-8 rounded-full bg-rose-500 flex items-center justify-center mr-4">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-700 group-hover:text-rose-700">
                        Thiết lập Quan hệ
                    </span>
                    <span class="ml-auto text-rose-400 group-hover:translate-x-1 transition-transform">→</span>
                </a>



                {{-- 4. Xem Cây Gia phả --}}
                <a href="{{ route('tree.index') }}" class="group flex items-center p-3 rounded-xl bg-green-50 hover:bg-green-100 transition duration-150">
                    <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center mr-4">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0zM5 15h14M7 11v4M17 11v4M12 5v2" />
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-700 group-hover:text-green-700">Xem Cây Gia phả</span>
                    <span class="ml-auto text-green-400 group-hover:translate-x-1 transition-transform">→</span>
                </a>

                {{-- 5. Quản lý Sự kiện --}}
                <a href="{{ route('events.index') }}" class="group flex items-center p-3 rounded-xl bg-blue-50 hover:bg-blue-100 transition duration-150">
                    <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center mr-4">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h.01M16 11h.01M4 21h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-700 group-hover:text-blue-700">Quản lý Sự kiện</span>
                    <span class="ml-auto text-blue-400 group-hover:translate-x-1 transition-transform">→</span>
                </a>

                {{-- 6. Thống kê Gia tộc --}}
                <a href="{{ route('statistic.index') }}" class="group flex items-center p-3 rounded-xl bg-indigo-50 hover:bg-indigo-100 transition duration-150">
                    <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center mr-4">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-700 group-hover:text-indigo-700">Thống kê Gia tộc</span>
                    <span class="ml-auto text-indigo-400 group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </ul>
        </div>

        {{-- Hoạt động & Sự kiện (Cột 2 và 3) --}}
        <div class="lg:col-span-2 space-y-8">

            {{-- ⏰ Hoạt động gần đây --}}
            <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100">
                <h3 class="text-2xl font-bold mb-5 text-gray-800 border-b pb-3 border-gray-100">⏰ Hoạt động gần đây</h3>
                <ul class="divide-y divide-gray-200">
                    @forelse($activities as $a)
                    <li class="py-4 flex justify-between items-center transition duration-150 ease-in-out hover:bg-gray-50 rounded-lg px-2 -mx-2">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 mt-0.5 mr-3 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2" />
                            </svg>
                            <div>
                                <div class="font-semibold text-gray-800">{{ $a['action'] }}</div>
                                <div class="text-sm text-gray-500 mt-1">{{ $a['detail'] }} — <span class="font-medium text-gray-600">{{ $a['by'] }}</span></div>
                            </div>
                        </div>
                        <div class="text-xs text-gray-400 font-light italic ml-4 flex-shrink-0">{{ $a['time'] }}</div>
                    </li>
                    @empty
                    <li class="py-6 text-gray-500 italic text-center bg-gray-50 rounded-lg">Chưa có hoạt động nào gần đây.</li>
                    @endforelse
                </ul>
                <div class="text-right mt-5 pt-3 border-t border-gray-100">
                    <a href="{{ route('activities.index') }}" class="text-sm font-semibold text-orange-600 hover:text-orange-700 transition duration-150">
                        Xem tất cả hoạt động →
                    </a>
                </div>
            </div>

            {{-- 📅 Sự kiện sắp tới --}}
            <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100">
                <h3 class="text-2xl font-bold mb-5 text-gray-800 border-b pb-3 border-gray-100">📅 Sự kiện sắp tới</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @forelse($events as $e)
                    <div class="p-4 rounded-xl bg-{{ $e['color'] }}-50 shadow-md border-l-4 border-{{ $e['color'] }}-500 transition duration-200 ease-in-out hover:shadow-lg hover:bg-{{ $e['color'] }}-100">
                        <div class="font-extrabold text-{{ $e['color'] }}-800 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $e['title'] }}
                        </div>
                        <div class="text-sm text-{{ $e['color'] }}-600 mt-1 font-medium">{{ $e['date'] }}</div>
                    </div>
                    @empty
                    <div class="sm:col-span-2 text-center text-gray-500 italic p-6 bg-gray-50 rounded-xl">
                        Không có sự kiện nào sắp diễn ra.
                    </div>
                    @endforelse
                </div>
                <div class="text-center mt-6 pt-4 border-t border-gray-100">
                    <a href="{{ route('events.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700 transition duration-150">
                        Quản lý và tạo sự kiện →
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection