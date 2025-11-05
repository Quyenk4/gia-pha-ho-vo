@extends('layouts.app')

@section('title', 'Quản lý Hôn nhân')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

  <h1 class="text-3xl font-bold text-pink-600 mb-6 border-b pb-2">💒 Quản lý Hôn nhân Gia tộc</h1>

  <div class="flex justify-between items-center mb-5">
    <p class="text-gray-500">Tổng số hôn nhân: {{ count($marriages ?? []) }}</p>
    <a href="{{ route('marriages.create') }}" 
       class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg shadow-md transition">
       + Thêm Hôn nhân mới
    </a>
  </div>

  <div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <table class="min-w-full border-collapse">
      <thead class="bg-pink-100 text-gray-700 uppercase text-sm">
        <tr>
          <th class="px-6 py-3 text-left">#</th>
          <th class="px-6 py-3 text-left">Chồng</th>
          <th class="px-6 py-3 text-left">Vợ</th>
          <th class="px-6 py-3 text-left">Ngày kết hôn</th>
          <th class="px-6 py-3 text-left">Ghi chú</th>
          <th class="px-6 py-3 text-right">Hành động</th>
        </tr>
      </thead>
      <tbody>
        @foreach($marriages ?? [] as $m)
          <tr class="border-b hover:bg-pink-50 transition">
            <td class="px-6 py-3">{{ $m['id'] }}</td>
            <td class="px-6 py-3 font-semibold text-gray-800">{{ $m['husband'] }}</td>
            <td class="px-6 py-3">{{ $m['wife'] }}</td>
            <td class="px-6 py-3 text-gray-600">{{ $m['date'] }}</td>
            <td class="px-6 py-3 italic text-gray-500">{{ $m['note'] }}</td>
            <td class="px-6 py-3 text-right space-x-2">
              <a href="#" class="text-blue-500 hover:underline">Sửa</a>
              <a href="#" class="text-red-500 hover:underline">Xóa</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
