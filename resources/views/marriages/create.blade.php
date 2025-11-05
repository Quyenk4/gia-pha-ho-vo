@extends('layouts.app')

@section('title', 'Thêm Hôn nhân')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 mt-8 rounded-xl shadow-lg">
  <h2 class="text-2xl font-bold text-pink-600 mb-6 border-b pb-2">💍 Thêm Hôn nhân mới</h2>

  <form action="#" method="POST" class="space-y-6">
    <div>
      <label class="block text-gray-700 font-semibold mb-2">Người chồng</label>
      <select class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-pink-500">
        <option>-- Chọn người chồng --</option>
        <option>Võ Văn Nam</option>
        <option>Võ Văn Lộc</option>
      </select>
    </div>

    <div>
      <label class="block text-gray-700 font-semibold mb-2">Người vợ</label>
      <select class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-pink-500">
        <option>-- Chọn người vợ --</option>
        <option>Võ Thị Hoa</option>
        <option>Trần Thị Cúc</option>
      </select>
    </div>

    <div>
      <label class="block text-gray-700 font-semibold mb-2">Ngày kết hôn</label>
      <input type="date" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-pink-500">
    </div>

    <div>
      <label class="block text-gray-700 font-semibold mb-2">Ghi chú</label>
      <textarea rows="3" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-pink-500" placeholder="Nhập thông tin thêm..."></textarea>
    </div>

    <div class="text-right">
      <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded-lg shadow-md transition">
        💾 Lưu Thông tin
      </button>
    </div>
  </form>
</div>
@endsection
