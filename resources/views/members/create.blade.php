@extends('layouts.app')

@section('title', 'Thêm Thành Viên Mới')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-extrabold mb-8 text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-700 tracking-tight flex items-center justify-center animate-fadeIn">
        <span class="mr-3 text-3xl transform rotate-6 inline-block">➕</span> Đăng Ký Thành Viên Mới
    </h1>

    <div class="bg-white p-8 rounded-3xl shadow-2xl border-t-4 border-indigo-500 transition duration-500 transform hover:shadow-3xl hover:-translate-y-0.5">
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-800 border-l-4 border-red-500 rounded-lg shadow-md animate-shake">
                <p class="font-bold flex items-center">
                    ⚠️ Lỗi nhập liệu! Vui lòng kiểm tra lại:
                </p>
                <ul class="list-disc list-inside mt-2 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Họ tên & Giới tính --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="FullName" class="block font-semibold mb-1 text-gray-700">Họ và tên <span class="text-red-500">*</span></label>
                    <input type="text" name="FullName" id="FullName" required value="{{ old('FullName') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 transition">
                </div>
                <div>
                    <label for="Gender" class="block font-semibold mb-1 text-gray-700">Giới tính</label>
                    <select name="Gender" id="Gender" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-4 focus:ring-pink-200">
                        <option value="">-- Chọn giới tính --</option>
                        <option value="Nam" {{ old('Gender')=='Nam' ? 'selected' : '' }}>Nam</option>
                        <option value="Nữ" {{ old('Gender')=='Nữ' ? 'selected' : '' }}>Nữ</option>
                        <option value="Khác" {{ old('Gender')=='Khác' ? 'selected' : '' }}>Khác</option>
                    </select>
                </div>
            </div>

            {{-- Ngày sinh & nơi sinh --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="DateOfBirth" class="block font-semibold mb-1 text-gray-700">Ngày sinh</label>
                    <input type="date" name="DateOfBirth" id="DateOfBirth" value="{{ old('DateOfBirth') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
                </div>
                <div>
                    <label for="DateOfDeath" class="block font-semibold mb-1 text-gray-700">Ngày mất</label>
                    <input type="date" name="DateOfDeath" id="DateOfDeath" value="{{ old('DateOfDeath') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
                </div>
                <div>
                    <label for="PlaceOfBirth" class="block font-semibold mb-1 text-gray-700">Nơi sinh</label>
                    <input type="text" name="PlaceOfBirth" id="PlaceOfBirth" value="{{ old('PlaceOfBirth') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
                </div>
            </div>

            {{-- Nghề nghiệp & Địa chỉ --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="Occupation" class="block font-semibold mb-1 text-gray-700">Nghề nghiệp</label>
                    <input type="text" name="Occupation" id="Occupation" value="{{ old('Occupation') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
                </div>
                <div>
                    <label for="CurrentAddress" class="block font-semibold mb-1 text-gray-700">Địa chỉ hiện tại</label>
                    <input type="text" name="CurrentAddress" id="CurrentAddress" value="{{ old('CurrentAddress') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
                </div>
            </div>

            {{-- Email & Điện thoại --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="Email" class="block font-semibold mb-1 text-gray-700">Email</label>
                    <input type="email" name="Email" id="Email" value="{{ old('Email') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
                </div>
                <div>
                    <label for="Phone" class="block font-semibold mb-1 text-gray-700">Số điện thoại</label>
                    <input type="tel" name="Phone" id="Phone" value="{{ old('Phone') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
                </div>
            </div>

            {{-- Thế hệ --}}
            <div>
                <label for="Generation" class="block font-semibold mb-1 text-gray-700">Thế hệ</label>
                <input type="number" name="Generation" id="Generation" value="{{ old('Generation') }}" min="1" class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
            </div>

            {{-- Ảnh đại diện --}}
            <div>
                <label for="Avatar" class="block font-semibold mb-1 text-gray-700">Ảnh đại diện</label>
                <input type="file" name="Avatar" id="Avatar" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
            </div>

            {{-- Tiểu sử --}}
            <div>
                <label for="Biography" class="block font-semibold mb-1 text-gray-700">Tiểu sử</label>
                <textarea name="Biography" id="Biography" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2.5">{{ old('Biography') }}</textarea>
            </div>

            {{-- Quan hệ Cha Mẹ --}}
            <div class="border-t pt-6 mt-6 border-gray-200">
                <h3 class="text-xl font-bold mb-4 text-indigo-600">Quan hệ Cha Mẹ</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="FatherID" class="block font-semibold mb-1 text-gray-700">Cha (nếu có)</label>
                        <select name="FatherID" id="FatherID" class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
                            <option value="">-- Chọn Cha --</option>
                            @foreach ($people as $p)
                                <option value="{{ $p->PersonalID }}">{{ $p->FullName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="MotherID" class="block font-semibold mb-1 text-gray-700">Mẹ (nếu có)</label>
                        <select name="MotherID" id="MotherID" class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
                            <option value="">-- Chọn Mẹ --</option>
                            @foreach ($people as $p)
                                <option value="{{ $p->PersonalID }}">{{ $p->FullName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Quan hệ Hôn nhân --}}
            <div class="border-t pt-6 mt-6 border-gray-200">
                <h3 class="text-xl font-bold mb-4 text-indigo-600">Thông tin Hôn nhân</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="SpouseID" class="block font-semibold mb-1 text-gray-700">Vợ / Chồng (nếu có)</label>
                        <select name="SpouseID" id="SpouseID" class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
                            <option value="">-- Chọn người kết hôn --</option>
                            @foreach ($people as $p)
                                <option value="{{ $p->PersonalID }}">{{ $p->FullName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="MarriageDate" class="block font-semibold mb-1 text-gray-700">Ngày kết hôn</label>
                        <input type="date" name="MarriageDate" id="MarriageDate" value="{{ old('MarriageDate') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
                    </div>
                    <div>
                        <label for="MarriageStatus" class="block font-semibold mb-1 text-gray-700">Trạng thái</label>
                        <select name="MarriageStatus" id="MarriageStatus" class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
                            <option value="Đang sống cùng">Đang sống cùng</option>
                            <option value="Đã ly hôn">Đã ly hôn</option>
                            <option value="Mất vợ">Mất vợ</option>
                            <option value="Mất chồng">Mất chồng</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Nút --}}
            <div class="flex justify-end pt-4 space-x-4">
                <a href="{{ route('members.index') }}" class="px-6 py-2 rounded-full font-bold text-gray-700 bg-gray-200 hover:bg-gray-300 transition">Hủy Bỏ</a>
                <button type="submit" class="px-8 py-2 rounded-full font-extrabold text-white bg-gradient-to-r from-indigo-600 to-blue-500 hover:from-indigo-700 hover:to-blue-600 shadow-lg">Thêm Thành Viên</button>
            </div>
        </form>
    </div>
</div>
@endsection
