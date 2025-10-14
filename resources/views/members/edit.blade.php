@extends('layouts.app')

@section('title','Chỉnh sửa thông tin thành viên')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    
    <h1 class="text-4xl font-extrabold mb-8 text-gray-800 flex items-center border-b pb-3">
        ✍️ Cập nhật Hồ sơ thành viên
    </h1>

    {{-- Form chỉnh sửa với thiết kế Card nổi bật --}}
    <form action="{{ url('/members/' . ($member['id'] ?? '')) }}" method="POST" enctype="multipart/form-data" 
          class="bg-white p-8 rounded-2xl shadow-2xl space-y-7 border border-gray-100">
        @csrf
        @method('PUT')
        
        {{-- Phần I: Thông tin Cơ bản --}}
        <div class="border-b pb-4">
            <h2 class="text-2xl font-bold text-blue-600 mb-4">Thông tin Cơ bản</h2>
            
            <div class="space-y-4">
                {{-- Họ và Tên --}}
                <div>
                    <label for="name" class="block font-semibold mb-1 text-gray-700">Họ và tên <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" 
                           class="w-full border-gray-300 rounded-xl px-4 py-2.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition duration-150 shadow-sm" 
                           value="{{ $member['name'] ?? '' }}" placeholder="Ví dụ: Võ Văn Thắng">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    {{-- Giới tính --}}
                    <div>
                        <label for="gender" class="block font-semibold mb-1 text-gray-700">Giới tính</label>
                        <select id="gender" name="gender" 
                                class="w-full border-gray-300 rounded-xl px-4 py-2.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition duration-150 shadow-sm">
                            <option value="Nam" {{ ($member['gender'] ?? '')=='Nam'?'selected':'' }}>👨 Nam</option>
                            <option value="Nữ" {{ ($member['gender'] ?? '')=='Nữ'?'selected':'' }}>👩 Nữ</option>
                            <option value="Khác" {{ ($member['gender'] ?? '')=='Khác'?'selected':'' }}>🏳️‍⚧️ Khác</option>
                        </select>
                    </div>
                    
                    {{-- Ngày sinh --}}
                    <div class="md:col-span-2">
                        <label for="birthday" class="block font-semibold mb-1 text-gray-700">Ngày sinh</label>
                        <input type="date" id="birthday" name="birthday" 
                               class="w-full border-gray-300 rounded-xl px-4 py-2.5 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition duration-150 shadow-sm" 
                               value="{{ $member['birthday'] ?? '' }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- Phần II: Thông tin Chi nhánh/Địa lý --}}
        <div class="border-b pb-4">
            <h2 class="text-2xl font-bold text-green-600 mb-4">Địa chỉ & Chi nhánh</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- Chi nhánh --}}
                <div>
                    <label for="branch" class="block font-semibold mb-1 text-gray-700">Chi nhánh/Thế hệ</label>
                    <input type="text" id="branch" name="branch" 
                           class="w-full border-gray-300 rounded-xl px-4 py-2.5 focus:border-green-500 focus:ring-1 focus:ring-green-500 transition duration-150 shadow-sm" 
                           value="{{ $member['branch'] ?? '' }}" placeholder="Ví dụ: Chi III - Huế">
                </div>
                
                {{-- Nơi sinh --}}
                <div>
                    <label for="birthplace" class="block font-semibold mb-1 text-gray-700">Nơi sinh</label>
                    <input type="text" id="birthplace" name="birthplace" 
                           class="w-full border-gray-300 rounded-xl px-4 py-2.5 focus:border-green-500 focus:ring-1 focus:ring-green-500 transition duration-150 shadow-sm" 
                           value="{{ $member['birthplace'] ?? '' }}" placeholder="Ví dụ: Làng An Truyền, Phú Vang">
                </div>

                {{-- Thêm trường Địa chỉ hiện tại (giả định) --}}
                <div class="md:col-span-2">
                    <label for="current_address" class="block font-semibold mb-1 text-gray-700">Địa chỉ hiện tại</label>
                    <input type="text" id="current_address" name="current_address" 
                           class="w-full border-gray-300 rounded-xl px-4 py-2.5 focus:border-green-500 focus:ring-1 focus:ring-green-500 transition duration-150 shadow-sm" 
                           value="{{ $member['current_address'] ?? '' }}" placeholder="Số nhà, đường, tỉnh/thành phố">
                </div>
            </div>
        </div>

        {{-- Phần III: Ảnh Đại diện --}}
        <div>
            <h2 class="text-2xl font-bold text-purple-600 mb-4">Ảnh Đại diện</h2>
            <div class="flex items-center space-x-6">
                @if($member['photo'] ?? false)
                <img src="{{ $member['photo'] }}" alt="Ảnh hiện tại" class="w-16 h-16 object-cover rounded-full border-2 border-purple-300 flex-shrink-0">
                @endif
                <div>
                    <label for="photo" class="block font-semibold mb-1 text-gray-700">Tải lên ảnh mới</label>
                    <input type="file" id="photo" name="photo" 
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 cursor-pointer">
                </div>
            </div>
        </div>


        {{-- Nút Hành động --}}
        <div class="pt-6 border-t border-gray-100 flex justify-end space-x-4">
            
            <a href="{{ url('/members/' . ($member['id'] ?? '')) }}" 
               class="px-6 py-2 text-gray-600 border border-gray-300 hover:bg-gray-100 rounded-xl transition font-medium flex items-center">
                Hủy
            </a>
            
            <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-xl shadow-lg transition duration-300 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Cập nhật thông tin
            </button>
        </div>
    </form>
</div>
@endsection