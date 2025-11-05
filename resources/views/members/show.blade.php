@extends('layouts.app')

@section('title', 'Chi Tiết Thành Viên: ' . ($member->FullName ?? ''))

@section('content')
@php
$is_male = ($member->Gender ?? '') === 'Nam';
$primary_color = $is_male ? 'blue' : 'pink';
$avatar_url = $member->Avatar
    ? asset('images/members/' . $member->Avatar)
    : asset('images/default_avatar.png');
@endphp

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 border-b-2 border-{{ $primary_color }}-200 pb-3">
        <h1 class="text-4xl font-extrabold text-gray-800 flex items-center">
            <span class="mr-3 text-3xl">{{ $is_male ? '👨' : '👩' }}</span>
            {{ $member->FullName }}
            <span class="ml-2 text-lg text-{{ $primary_color }}-600">
                (Thế hệ {{ $member->Generation ?? '?' }})
            </span>
        </h1>

        <div class="flex space-x-3 mt-4 sm:mt-0">
            <a href="{{ route('members.edit', $member->PersonalID) }}"
               class="px-5 py-2 bg-green-500 text-white rounded-full font-semibold hover:bg-green-600 transition transform hover:scale-105 shadow-md flex items-center">
                ✏️ Sửa
            </a>

            <form action="{{ route('members.destroy', $member->PersonalID) }}" method="POST"
                  onsubmit="return confirm('⚠️ Bạn có chắc muốn xóa {{ $member->FullName }} không?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-5 py-2 bg-red-500 text-white rounded-full font-semibold hover:bg-red-600 transition transform hover:scale-105 shadow-md flex items-center">
                    🗑️ Xóa
                </button>
            </form>
        </div>
    </div>

    {{-- THÔNG TIN CHÍNH --}}
    <div class="bg-white rounded-2xl shadow-xl border-t-8 border-{{ $primary_color }}-500 p-8 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">

            {{-- ẢNH --}}
            <div class="flex flex-col items-center">
                <img src="{{ $avatar_url }}" alt="{{ $member->FullName }}"
                     class="w-40 h-40 rounded-full object-cover border-4 border-{{ $primary_color }}-300 shadow-lg mb-4">
                <p class="text-gray-600 italic text-sm">
                    {{ $member->DateOfDeath ? 'Đã mất' : 'Còn sống' }}
                </p>
            </div>

            {{-- THÔNG TIN CÁ NHÂN --}}
            <div class="md:col-span-2 space-y-4 text-gray-800 text-base">
                <p><strong>Giới tính:</strong> {{ $member->Gender ?? 'Chưa rõ' }}</p>
                <p><strong>Ngày sinh:</strong>
                    {{ $member->DateOfBirth ? \Carbon\Carbon::parse($member->DateOfBirth)->format('d/m/Y') : 'Chưa rõ' }}
                </p>
                <p><strong>Ngày mất:</strong>
                    {{ $member->DateOfDeath ? \Carbon\Carbon::parse($member->DateOfDeath)->format('d/m/Y') : 'Còn sống' }}
                </p>
                <p><strong>Nơi sinh:</strong> {{ $member->PlaceOfBirth ?? 'Chưa rõ' }}</p>
                <p><strong>Nghề nghiệp:</strong> {{ $member->Occupation ?? 'Chưa rõ' }}</p>
            </div>
        </div>
    </div>

    {{-- QUAN HỆ GIA ĐÌNH --}}
<div class="bg-gray-50 rounded-2xl shadow-md border border-gray-200 p-6">
    <h2 class="text-2xl font-bold text-{{ $primary_color }}-600 mb-4">👨‍👩‍👧‍👦 Quan Hệ Gia Đình</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-800">

        {{-- Cha mẹ --}}
        <div>
        @php
    $father = $member->father->first();
    $mother = $member->mother->first();
@endphp

<p><strong>👨 Cha:</strong> {{ $father->FullName ?? 'Chưa rõ' }}</p>
<p><strong>👩 Mẹ:</strong> {{ $mother->FullName ?? 'Chưa rõ' }}</p>


            {{-- Vợ / Chồng --}}
            @if ($member->Gender === 'Nam')
                @php
                    $marriage = $member->marriagesAsHusband->first();
                    $spouse = optional(optional($marriage)->wife)->FullName;
                @endphp
                <p><strong>💍 Vợ:</strong> {{ $spouse ?? 'Chưa rõ' }}</p>
            @elseif ($member->Gender === 'Nữ')
                @php
                    $marriage = $member->marriagesAsWife->first();
                    $spouse = optional(optional($marriage)->husband)->FullName;
                @endphp
                <p><strong>💍 Chồng:</strong> {{ $spouse ?? 'Chưa rõ' }}</p>
            @endif
        </div>

        {{-- Con cái --}}
        <div>
            <p><strong>👶 Con cái:</strong></p>
            @if ($member->children && $member->children->count() > 0)
                <ul class="list-disc ml-6 mt-1">
                    @foreach ($member->children as $child)
                        <li>
                            <a href="{{ route('members.show', $child->PersonalID) }}"
                               class="text-{{ $primary_color }}-600 font-medium hover:underline">
                                {{ $child->FullName }}
                            </a>
                            <span class="text-sm text-gray-500">(Thế hệ {{ $child->Generation }})</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="italic text-gray-500 ml-2">Chưa có thông tin con cái.</p>
            @endif
        </div>
    </div>
</div>

    {{-- NÚT QUAY LẠI --}}
    <div class="mt-8 flex justify-end">
        <a href="{{ route('members.index') }}"
           class="px-6 py-2 bg-gray-200 text-gray-700 font-semibold rounded-full hover:bg-gray-300 transition transform hover:scale-[1.03] shadow-md flex items-center">
            ⬅️ Quay lại danh sách
        </a>
    </div>

</div>
@endsection
