@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Thiết lập Quan hệ</h1>

    {{-- =============== FORM THÊM QUAN HỆ =============== --}}
  <form action="{{ route('relationships.store') }}" method="POST" class="bg-white p-6 rounded-xl shadow-md">

        @csrf

        {{-- Chọn loại quan hệ --}}
        <div class="mb-4">
            <label for="relation_type" class="block font-semibold text-gray-700 mb-2">Loại quan hệ:</label>
            <select id="relation_type" name="relation_type" class="border border-gray-300 rounded-lg p-2 w-full">
                <option value="">-- Chọn loại quan hệ --</option>
                <option value="marriage">Hôn nhân (Vợ - Chồng)</option>
                <option value="parent_child">Cha / Mẹ - Con</option>
            </select>
        </div>

        {{-- ========== FORM HÔN NHÂN (ẩn/hiện theo chọn) ========== --}}
        <div id="marriage-section" class="hidden border-t border-gray-200 pt-4">
            <h2 class="font-semibold text-gray-700 mb-3">Quan hệ Hôn nhân</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Chồng --}}
                <div>
                    <label class="block text-gray-600 mb-1">Chồng:</label>
                    <select name="husband_id" class="border rounded-lg p-2 w-full">
                        <option value="">-- Chọn chồng --</option>
                        @foreach($people as $person)
                            @if($person->Gender == 'Nam')
                                <option value="{{ $person->PersonalID }}">{{ $person->FullName }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                {{-- Vợ --}}
                <div>
                    <label class="block text-gray-600 mb-1">Vợ:</label>
                    <select name="wife_id" class="border rounded-lg p-2 w-full">
                        <option value="">-- Chọn vợ --</option>
                        @foreach($people as $person)
                            @if($person->Gender == 'Nữ')
                                <option value="{{ $person->PersonalID }}">{{ $person->FullName }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                {{-- Ngày kết hôn --}}
                <div>
                    <label class="block text-gray-600 mb-1">Ngày kết hôn:</label>
                    <input type="date" name="marriage_date" class="border rounded-lg p-2 w-full">
                </div>

                {{-- Trạng thái --}}
                <div>
                    <label class="block text-gray-600 mb-1">Trạng thái:</label>
                    <select name="status" class="border rounded-lg p-2 w-full">
                        <option value="Đang sống chung">Đang sống chung</option>
                        <option value="Ly hôn">Ly hôn</option>
                        <option value="Mất vợ">Mất vợ</option>
                        <option value="Mất chồng">Mất chồng</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- ========== FORM CHA - MẸ - CON (ẩn/hiện theo chọn) ========== --}}
        <div id="parent-section" class="hidden border-t border-gray-200 pt-4">
            <h2 class="font-semibold text-gray-700 mb-3">Quan hệ Cha / Mẹ - Con</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Cha --}}
                <div>
                    <label class="block text-gray-600 mb-1">Cha:</label>
                    <select name="father_id" class="border rounded-lg p-2 w-full">
                        <option value="">-- Chọn cha --</option>
                        @foreach($people as $person)
                            @if($person->Gender == 'Nam')
                                <option value="{{ $person->PersonalID }}">{{ $person->FullName }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                {{-- Mẹ --}}
                <div>
                    <label class="block text-gray-600 mb-1">Mẹ:</label>
                    <select name="mother_id" class="border rounded-lg p-2 w-full">
                        <option value="">-- Chọn mẹ --</option>
                        @foreach($people as $person)
                            @if($person->Gender == 'Nữ')
                                <option value="{{ $person->PersonalID }}">{{ $person->FullName }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                {{-- Con --}}
                <div class="md:col-span-2">
                    <label class="block text-gray-600 mb-1">Con:</label>
                    <select name="child_id" class="border rounded-lg p-2 w-full">
                        <option value="">-- Chọn con --</option>
                        @foreach($people as $person)
                            <option value="{{ $person->PersonalID }}">{{ $person->FullName }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Kiểu quan hệ --}}
                <div class="md:col-span-2">
                    <label class="block text-gray-600 mb-1">Kiểu quan hệ:</label>
                    <select name="relation_type_detail" class="border rounded-lg p-2 w-full">
                        <option value="Cha - Con">Cha - Con</option>
                        <option value="Mẹ - Con">Mẹ - Con</option>
                        <option value="Cha Mẹ - Con">Cha Mẹ - Con</option>
                        <option value="Mồ côi">Mồ côi</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Nút lưu --}}
        <div class="mt-6 text-right">
            <button type="submit" class="bg-rose-500 hover:bg-rose-600 text-white px-6 py-2 rounded-lg">
                Lưu quan hệ
            </button>
        </div>
    </form>

    {{-- =============== DANH SÁCH QUAN HỆ =============== --}}
    <div class="mt-10">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Danh sách quan hệ hiện có</h2>

        {{-- Hôn nhân --}}
        <div class="mb-6">
            <h3 class="font-bold text-rose-600 mb-2">Quan hệ Hôn nhân</h3>
            <table class="min-w-full border border-gray-300 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-3 py-2">STT</th>
                        <th class="border px-3 py-2">Chồng</th>
                        <th class="border px-3 py-2">Vợ</th>
                        <th class="border px-3 py-2">Ngày cưới</th>
                        <th class="border px-3 py-2">Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($marriages as $index => $m)
                        <tr>
                            <td class="border px-3 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="border px-3 py-2">{{ $m->husband->FullName ?? '-' }}</td>
                            <td class="border px-3 py-2">{{ $m->wife->FullName ?? '-' }}</td>
                            <td class="border px-3 py-2">{{ $m->MarriageDate ?? '-' }}</td>
                            <td class="border px-3 py-2">{{ $m->Status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Cha - mẹ - con --}}
        <div>
            <h3 class="font-bold text-rose-600 mb-2">Quan hệ Cha / Mẹ - Con</h3>
            <table class="min-w-full border border-gray-300 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-3 py-2">STT</th>
                        <th class="border px-3 py-2">Cha/Mẹ</th>
                        <th class="border px-3 py-2">Con</th>
                        <th class="border px-3 py-2">Kiểu quan hệ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($relations as $index => $r)
                        <tr>
                            <td class="border px-3 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="border px-3 py-2">{{ $r->parent->FullName ?? '-' }}</td>
                            <td class="border px-3 py-2">{{ $r->child->FullName ?? '-' }}</td>
                            <td class="border px-3 py-2">{{ $r->RelationType }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- =============== SCRIPT ẨN/HIỆN FORM =============== --}}
<script>
document.getElementById('relation_type').addEventListener('change', function() {
    const marriageSection = document.getElementById('marriage-section');
    const parentSection = document.getElementById('parent-section');

    marriageSection.classList.add('hidden');
    parentSection.classList.add('hidden');

    if (this.value === 'marriage') {
        marriageSection.classList.remove('hidden');
    } else if (this.value === 'parent_child') {
        parentSection.classList.remove('hidden');
    }
});
</script>
@endsection
