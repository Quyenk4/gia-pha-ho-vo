@extends('layouts.app')

@section('title', 'Cây Gia Phả')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4">🌳 CÂY GIA PHẢ HỌ VÕ 🌳</h2>

    <div class="tree text-center">
        @foreach ($people as $person)
            @if ($person->ParentID === null)
                @include('tree.node', ['person' => $person])
            @endif
        @endforeach
    </div>
</div>

<style>
.tree ul {
    padding-top: 20px;
    position: relative;
    transition: all 0.5s;
    display: inline-block;
}

.tree li {
    display: inline-block;
    vertical-align: top;
    text-align: center;
    position: relative;
    padding: 20px 5px 0 5px;
    list-style-type: none;
}

/* các đường nối giữa các node */
.tree li::before, .tree li::after {
    content: '';
    position: absolute;
    top: 0;
    right: 50%;
    border-top: 2px solid #ccc;
    width: 50%;
    height: 20px;
}
.tree li::after {
    right: auto;
    left: 50%;
    border-left: 2px solid #ccc;
}

/* ẩn nhánh nối nếu là node gốc */
.tree li:only-child::before, .tree li:only-child::after {
    display: none;
}
.tree li:only-child {
    padding-top: 0;
}
.tree li:first-child::before, .tree li:last-child::after {
    border: 0 none;
}
.tree li:last-child::before {
    border-right: 2px solid #ccc;
    border-radius: 0 5px 0 0;
}
.tree li:first-child::after {
    border-radius: 5px 0 0 0;
}

/* khối hiển thị người */
.tree .person {
    display: inline-block;
    border: 2px solid #007bff;
    border-radius: 10px;
    padding: 10px 15px;
    background-color: #f8f9fa;
    transition: all 0.3s;
}
.tree .person:hover {
    background-color: #e9f5ff;
    transform: scale(1.05);
}
.person .name {
    font-weight: bold;
    color: #0d6efd;
}
.person .gender {
    font-size: 0.9em;
    color: #666;
}
</style>
@endsection
