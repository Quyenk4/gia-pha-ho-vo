@extends('layouts.app')

@section('title','Thêm thành viên mới')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    
    <h1 class="text-4xl font-extrabold mb-8 text-gray-800 flex items-center border-b pb-3">
        ➕ Thêm Thành viên mới vào Gia Phả
    </h1>

    {{-- Form thêm mới với thiết kế Card nổi bật --}}
    <form action="#" method="POST" enctype="multipart/form-data" 
          class="bg-white p-8 rounded-2xl shadow-2xl space-y-7 border border-gray-100">
        @csrf
        
        {{-- Phần I: Thông tin Cơ bản --}}
        <div class="border-b pb-4">
            <h2 class="text-2xl font-bold text-blue-600 mb-4">Thông tin Cơ bản</h2>
            
            <div class="space-y-4">
                {{-- Họ và Tên --}}
                <div>
                    <label for="name" class="block font-semibold mb-1 text-gray-700">Họ và tên <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" 
                           class="w-full border-gray-300 rounded-xl px-4 py-2.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition duration-150 shadow-sm" 
                           placeholder="Nhập họ và tên đầy đủ">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    {{-- Giới tính --}}
                    <div>
                        <label for="gender" class="block font-semibold mb-1 text-gray-700">Giới tính</label>
                        <select id="gender" name="gender" 
                                class="w-full border-gray-300 rounded-xl px-4 py-2.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition duration-150 shadow-sm">
                            <option value="Nam">👨 Nam</option>
                            <option value="Nữ">👩 Nữ</option>
                            <option value="Khác">🏳️‍⚧️ Khác</option>
                        </select>
                    </div>
                    
                    {{-- Ngày sinh --}}
                    <div class="md:col-span-2">
                        <label for="birthday" class="block font-semibold mb-1 text-gray-700">Ngày sinh</label>
                        <input type="date" id="birthday" name="birthday" 
                               class="w-full border-gray-300 rounded-xl px-4 py-2.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition duration-150 shadow-sm">
                    </div>
                </div>
            </div>
        </div>

        {{-- Phần II: Thông tin Chi nhánh & Thế hệ --}}
        <div class="border-b pb-4">
            <h2 class="text-2xl font-bold text-teal-600 mb-4">Chi nhánh & Thế hệ</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                {{-- Chi nhánh --}}
                <div>
                    <label for="branch" class="block font-semibold mb-1 text-gray-700">Chi nhánh/Khu vực</label>
                    <input type="text" id="branch" name="branch" 
                           class="w-full border-gray-300 rounded-xl px-4 py-2.5 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition duration-150 shadow-sm" 
                           placeholder="Ví dụ: Chi III - Huế">
                </div>
                
                {{-- Thế hệ --}}
                <div>
                    <label for="generation" class="block font-semibold mb-1 text-gray-700">Thế hệ (Số La Mã)</label>
                    <input type="text" id="generation" name="generation" 
                           class="w-full border-gray-300 rounded-xl px-4 py-2.5 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition duration-150 shadow-sm" 
                           placeholder="Ví dụ: IX">
                </div>

                {{-- Nơi sinh --}}
                <div>
                    <label for="birthplace" class="block font-semibold mb-1 text-gray-700">Nơi sinh</label>
                    <input type="text" id="birthplace" name="birthplace" 
                           class="w-full border-gray-300 rounded-xl px-4 py-2.5 focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition duration-150 shadow-sm" 
                           placeholder="Tỉnh/Thành phố">
                </div>
            </div>
        </div>
        
        {{-- Phần III: Ảnh Đại diện --}}
        <div>
            <h2 class="text-2xl font-bold text-purple-600 mb-4">Ảnh Đại diện</h2>
            <label for="photo" class="block font-semibold mb-1 text-gray-700">Tải lên ảnh thành viên</label>
            <input type="file" id="photo" name="photo" 
                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 cursor-pointer">
        </div>

        {{-- Nút Hành động --}}
        <div class="pt-6 border-t border-gray-100 flex justify-end space-x-4">
            
            <a href="{{ route('members.index') }}" 
               class="px-6 py-2 text-gray-600 border border-gray-300 hover:bg-gray-100 rounded-xl transition font-medium flex items-center">
                Hủy
            </a>
            
            <button type="submit" 
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-xl shadow-lg transition duration-300 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Lưu Thành Viên
            </button>
        </div>
    </form>
</div>
@endsection