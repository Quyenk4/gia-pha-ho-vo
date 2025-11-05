@extends('layouts.app')

@section('title', 'Sửa Thành Viên: ' . ($member->FullName ?? ''))

@section('content')
@php
$avatar_url = $member->Avatar
    ? asset('images/members/' . $member->Avatar)
    : asset('images/default_avatar.png');
$primary_color = 'green';
@endphp

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- TIÊU ĐỀ --}}
    <h1 class="text-4xl font-extrabold mb-8 text-center text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-teal-700 tracking-tight flex items-center justify-center animate-fadeIn">
        <span class="mr-3 text-3xl transform rotate-6 inline-block">✏️</span> 
        Chỉnh Sửa Thành Viên: {{ $member->FullName }}
    </h1>

    <div class="bg-white p-8 rounded-2xl shadow-2xl border-t-4 border-{{ $primary_color }}-500 transition duration-500 transform hover:-translate-y-1 hover:shadow-3xl">

        {{-- THÔNG BÁO LỖI --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-800 border-l-4 border-red-500 rounded-lg shadow-md">
                <p class="font-bold flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 9v2m0 4h.01M6.938 18h10.124c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.354 15c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    Vui lòng kiểm tra lại thông tin:
                </p>
                <ul class="list-disc list-inside mt-2 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM CHÍNH --}}
        <form action="{{ route('members.update', $member->PersonalID) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Họ và tên --}}
            <div>
                <label class="block font-semibold mb-1 text-gray-700">Họ và tên <span class="text-red-500">*</span></label>
                <input type="text" name="FullName" value="{{ old('FullName', $member->FullName) }}" required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-4 focus:ring-green-200 focus:border-green-500 transition duration-300 shadow-inner"
                       placeholder="Nhập họ và tên">
            </div>

            {{-- Giới tính + Thế hệ --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-semibold mb-1 text-gray-700">Giới tính</label>
                    <select name="Gender" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-white focus:ring-4 focus:ring-teal-200 focus:border-teal-500 transition">
                        <option value="">-- Chọn --</option>
                        <option value="Nam" {{ old('Gender', $member->Gender) == 'Nam' ? 'selected' : '' }}>👨 Nam</option>
                        <option value="Nữ" {{ old('Gender', $member->Gender) == 'Nữ' ? 'selected' : '' }}>👩 Nữ</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold mb-1 text-gray-700">Thế hệ</label>
                    <input type="number" name="Generation" value="{{ old('Generation', $member->Generation) }}" min="1"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-4 focus:ring-lime-200 focus:border-lime-500 transition shadow-inner"
                           placeholder="Ví dụ: 3">
                </div>
            </div>

            {{-- Cha, Mẹ --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="FatherID" class="block font-semibold mb-1 text-gray-700">Cha (nếu có)</label>
                    <select name="FatherID" id="FatherID" class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
                        <option value="">-- Không có / Không chọn --</option>
                        @foreach ($people as $p)
                            <option value="{{ $p->PersonalID }}" {{ old('FatherID', $member->FatherID) == $p->PersonalID ? 'selected' : '' }}>
                                {{ $p->FullName }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="MotherID" class="block font-semibold mb-1 text-gray-700">Mẹ (nếu có)</label>
                    <select name="MotherID" id="MotherID" class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
                        <option value="">-- Không có / Không chọn --</option>
                        @foreach ($people as $p)
                            <option value="{{ $p->PersonalID }}" {{ old('MotherID', $member->MotherID) == $p->PersonalID ? 'selected' : '' }}>
                                {{ $p->FullName }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Vợ / Chồng --}}
            <div>
                <label for="SpouseID" class="block font-semibold mb-1 text-gray-700">Vợ / Chồng (nếu có)</label>
                <select name="SpouseID" id="SpouseID" class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
                    <option value="">-- Không có / Không chọn --</option>
                    @foreach ($people as $p)
                        @if ($p->PersonalID != $member->PersonalID)
                            <option value="{{ $p->PersonalID }}" {{ old('SpouseID', $member->SpouseID) == $p->PersonalID ? 'selected' : '' }}>
                                {{ $p->FullName }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            {{-- Ngày sinh, ngày mất, nơi sinh --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block font-semibold mb-1 text-gray-700">Ngày sinh</label>
                    <input type="date" name="DateOfBirth"
                           value="{{ old('DateOfBirth', $member->DateOfBirth ? \Carbon\Carbon::parse($member->DateOfBirth)->format('Y-m-d') : null) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-4 focus:ring-green-200 focus:border-green-500 transition shadow-inner">
                </div>

                <div>
                    <label class="block font-semibold mb-1 text-gray-700">Ngày mất</label>
                    <input type="date" name="DateOfDeath"
                           value="{{ old('DateOfDeath', $member->DateOfDeath ? \Carbon\Carbon::parse($member->DateOfDeath)->format('Y-m-d') : null) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-4 focus:ring-gray-200 focus:border-gray-500 transition shadow-inner">
                </div>

                <div>
                    <label class="block font-semibold mb-1 text-gray-700">Nơi sinh</label>
                    <input type="text" name="PlaceOfBirth" value="{{ old('PlaceOfBirth', $member->PlaceOfBirth) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-4 focus:ring-yellow-200 focus:border-yellow-500 transition shadow-inner"
                           placeholder="Tên tỉnh/thành phố">
                </div>
            </div>

            {{-- Nghề nghiệp --}}
            <div>
                <label class="block font-semibold mb-1 text-gray-700">Nghề nghiệp</label>
                <input type="text" name="Occupation" value="{{ old('Occupation', $member->Occupation) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-4 focus:ring-emerald-200 focus:border-emerald-500 transition shadow-inner"
                       placeholder="Ví dụ: Giáo viên, Kỹ sư...">
            </div>

            {{-- Ảnh đại diện --}}
            <div>
                <label class="block font-semibold mb-2 text-gray-700">📸 Ảnh đại diện</label>
                <div class="flex items-center space-x-4 mb-4">
                    <img src="{{ $avatar_url }}" alt="{{ $member->FullName }}" class="w-24 h-24 object-cover rounded-full border-4 border-gray-200 shadow-md">
                    <p class="text-sm text-gray-500">
                        @if ($member->Avatar)
                            Ảnh hiện tại — chọn ảnh mới để thay thế.
                        @else
                            Thành viên chưa có ảnh đại diện.
                        @endif
                    </p>
                </div>
                <input type="file" name="Avatar" accept="image/*"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-4 focus:ring-green-200 focus:border-green-500 transition shadow-inner">
            </div>

            {{-- Nút hành động --}}
            <div class="flex justify-end pt-4 space-x-4">
                <a href="{{ route('members.show', $member->PersonalID) }}"
                   class="px-6 py-2 rounded-full font-bold text-gray-700 bg-gray-200 hover:bg-gray-300 transition transform hover:scale-105 shadow-md flex items-center">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg> Hủy
                </a>

                <button type="submit"
                        class="px-8 py-2 rounded-full font-extrabold text-white bg-gradient-to-r from-green-600 to-teal-500 hover:from-green-700 hover:to-teal-600 transition transform hover:scale-105 shadow-lg hover:ring-4 ring-green-300 active:scale-95 flex items-center">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4L12 7m0 0l-4 4m4-4v12"/>
                    </svg> Lưu Thay Đổi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
