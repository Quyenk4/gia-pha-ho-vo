@extends('layouts.app')

@section('title','Chi tiết thành viên')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    
    {{-- Khối chính - Thẻ Chi tiết --}}
    <div class="bg-white rounded-2xl shadow-2xl p-8 border-t-8 border-orange-500">
        
        {{-- Phần Tiêu Đề và Ảnh Đại Diện --}}
        <div class="flex flex-col sm:flex-row items-center sm:items-start space-y-5 sm:space-y-0 sm:space-x-8 pb-6 border-b border-gray-100">
            
            <div class="flex-shrink-0">
                <img src="{{ $member['photo'] ?? '/images/default-avatar.png' }}" 
                     alt="{{ $member['name'] ?? 'Thành viên' }}"
                     class="w-36 h-36 object-cover rounded-full border-4 border-orange-500 shadow-lg">
            </div>
            
            <div class="text-center sm:text-left">
                <h2 class="text-4xl font-extrabold text-gray-900 mb-1">
                    {{ $member['name'] ?? 'Chưa xác định' }}
                </h2>
                
                {{-- Thông tin nổi bật --}}
                <p class="text-lg font-semibold text-orange-600 mt-1">
                    Thế hệ: {{ $member['generation'] ?? '—' }}
                </p>
                <p class="text-md text-gray-500 mt-1">
                    <span class="font-medium text-gray-700">{{ $member['gender'] ?? '—' }}</span> | Sinh ngày: <span class="font-medium text-gray-700">{{ $member['birthday'] ?? '—' }}</span>
                </p>
            </div>
        </div>

        {{-- Chi tiết Thông tin Cá nhân --}}
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-y-5 gap-x-10">
            
            {{-- Mục 1: Chi nhánh --}}
            <div class="flex items-center space-x-3 p-3 bg-orange-50 rounded-lg">
                <span class="text-xl text-orange-600">🏛</span>
                <div>
                    <div class="text-sm font-semibold text-gray-500">Chi nhánh</div>
                    <div class="text-base font-medium text-gray-800">{{ $member['branch'] ?? '—' }}</div>
                </div>
            </div>
            
            {{-- Mục 2: Nơi sinh --}}
            <div class="flex items-center space-x-3 p-3 bg-orange-50 rounded-lg">
                <span class="text-xl text-orange-600">📍</span>
                <div>
                    <div class="text-sm font-semibold text-gray-500">Nơi sinh</div>
                    <div class="text-base font-medium text-gray-800">{{ $member['birthplace'] ?? '—' }}</div>
                </div>
            </div>

            {{-- Có thể thêm các trường khác nếu dữ liệu có sẵn (ví dụ: Địa chỉ, Nghề nghiệp) --}}
            @if(isset($member['current_address']))
            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg md:col-span-2">
                <span class="text-xl text-gray-600">🏠</span>
                <div>
                    <div class="text-sm font-semibold text-gray-500">Địa chỉ hiện tại</div>
                    <div class="text-base font-medium text-gray-800">{{ $member['current_address'] }}</div>
                </div>
            </div>
            @endif
        </div>

        {{-- Quan hệ Gia đình --}}
        <div class="mt-10 pt-4 border-t border-gray-200">
            <h3 class="font-extrabold text-2xl text-gray-800 mb-4 flex items-center">
                🔗 Quan hệ Gia đình
            </h3>
            
            <ul class="space-y-3">
                <li class="p-3 bg-blue-50 border-l-4 border-blue-400 rounded-lg flex justify-between items-center">
                    <div class="font-semibold text-blue-800">Cha:</div>
                    <div class="text-gray-800 font-medium">Võ Văn A</div>
                </li>
                <li class="p-3 bg-purple-50 border-l-4 border-purple-400 rounded-lg flex justify-between items-center">
                    <div class="font-semibold text-purple-800">Mẹ:</div>
                    <div class="text-gray-800 font-medium">Nguyễn Thị B</div>
                </li>
                <li class="p-3 bg-yellow-50 border-l-4 border-yellow-400 rounded-lg">
                    <div class="font-semibold text-yellow-800 mb-1">Anh/Em:</div>
                    <div class="text-gray-800 font-medium">Võ Văn C, Võ Thị D</div>
                </li>
            </ul>
        </div>

        {{-- Nút Hành động --}}
        <div class="mt-10 pt-6 border-t border-gray-200 flex justify-end space-x-4">
            <a href="{{ route('members.index') }}" 
               class="px-5 py-2 text-gray-600 border border-gray-300 hover:bg-gray-100 rounded-xl transition font-medium">
                Quay lại
            </a>
            <a href="{{ url('/members/'.$member['id'].'/edit') }}" 
               class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded-xl shadow-lg transition duration-300 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-9-1.414l6.364-6.364m-4.243 4.243L19 7m-6 4l6.364-6.364"/></svg>
                Chỉnh sửa
            </a>
        </div>
        
    </div>
</div>
@endsection