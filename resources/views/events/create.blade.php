@extends('layouts.app')

@section('title', 'Thêm sự kiện mới')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    
    <h1 class="text-4xl font-extrabold mb-8 text-gray-800 flex items-center border-b pb-3">
        🗓️ Tạo Sự kiện Mới
    </h1>

    {{-- Form thêm mới với thiết kế Card nổi bật --}}
    <form action="#" method="POST" enctype="multipart/form-data" 
          class="bg-white p-8 rounded-2xl shadow-2xl space-y-7 border border-gray-100">
        @csrf
        
        {{-- Phần I: Thông tin Cơ bản --}}
        <div class="border-b pb-4">
            <h2 class="text-2xl font-bold text-purple-600 mb-4">Thông tin Sự kiện</h2>
            
            <div class="space-y-4">
                {{-- Tên sự kiện --}}
                <div>
                    <label for="title" class="block font-semibold mb-1 text-gray-700">Tên sự kiện <span class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" 
                           class="w-full border-gray-300 rounded-xl px-4 py-2.5 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition duration-150 shadow-sm" 
                           placeholder="VD: Lễ giỗ Tổ họ Võ Huế">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    {{-- Ngày tổ chức --}}
                    <div>
                        <label for="date" class="block font-semibold mb-1 text-gray-700">Ngày tổ chức</label>
                        <input type="date" id="date" name="date" 
                               class="w-full border-gray-300 rounded-xl px-4 py-2.5 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition duration-150 shadow-sm">
                    </div>
                    
                    {{-- Loại sự kiện --}}
                    <div class="md:col-span-2">
                        <label for="type" class="block font-semibold mb-1 text-gray-700">Loại sự kiện</label>
                        <select id="type" name="type" 
                                class="w-full border-gray-300 rounded-xl px-4 py-2.5 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition duration-150 shadow-sm">
                            <option>Lễ giỗ</option>
                            <option>Họp họ</option>
                            <option>Sinh nhật</option>
                            <option>Hoạt động thiện nguyện</option>
                            <option>Khác</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- Phần II: Địa điểm & Mô tả --}}
        <div class="border-b pb-4">
            <h2 class="text-2xl font-bold text-indigo-600 mb-4">Địa điểm & Nội dung</h2>
            
            <div class="space-y-4">
                {{-- Địa điểm --}}
                <div>
                    <label for="location" class="block font-semibold mb-1 text-gray-700">Địa điểm tổ chức</label>
                    <input type="text" id="location" name="location" 
                           class="w-full border-gray-300 rounded-xl px-4 py-2.5 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-150 shadow-sm" 
                           placeholder="VD: Nhà thờ họ Võ, Thừa Thiên Huế">
                </div>
                
                {{-- Mô tả chi tiết --}}
                <div>
                    <label for="description" class="block font-semibold mb-1 text-gray-700">Mô tả chi tiết</label>
                    <textarea id="description" name="description" rows="5" 
                              class="w-full border-gray-300 rounded-xl px-4 py-2.5 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-150 shadow-sm" 
                              placeholder="Mô tả sự kiện, nội dung, người chủ trì..."></textarea>
                </div>
            </div>
        </div>
        
        {{-- Phần III: Ảnh minh họa --}}
        <div>
            <h2 class="text-2xl font-bold text-green-600 mb-4">Ảnh minh họa</h2>
            <label for="image" class="block font-semibold mb-1 text-gray-700">Tải lên ảnh đại diện cho sự kiện</label>
            <input type="file" id="image" name="image" 
                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 cursor-pointer">
        </div>

        {{-- Nút Hành động --}}
        <div class="pt-6 border-t border-gray-100 flex justify-end space-x-4">
            
            <a href="{{ route('events.index') }}" 
               class="px-6 py-2 text-gray-600 border border-gray-300 hover:bg-gray-100 rounded-xl transition font-medium flex items-center">
                Hủy
            </a>
            
            <button type="submit" 
                    class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-2 rounded-xl shadow-lg transition duration-300 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Lưu Sự kiện
            </button>
        </div>
    </form>
</div>
@endsection