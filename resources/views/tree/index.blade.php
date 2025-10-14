@extends('layouts.app')

@section('title','Cây gia phả')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100">
        <h2 class="text-3xl font-extrabold mb-6 text-gray-800 border-b pb-3 flex items-center">
            🌳 Sơ đồ Cây Gia phả Tộc Võ
        </h2>

        {{-- Khung chứa cây và thiết lập font chữ --}}
        <div id="tree-wrap" class="overflow-x-auto p-4 font-sans" style="min-height: 500px;">
            <div class="tree-container">
                <ul class="root-node">
                    {{-- Giả định biến $tree được truyền vào và cấp độ bắt đầu là 1 --}}
                    @foreach($tree as $node)
                        @include('tree.partials.node', ['node' => $node, 'level' => 1])
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* CSS TÙY CHỈNH CHO SƠ ĐỒ CÂY */

.tree-container ul {
    list-style: none;
    padding-left: 0;
    position: relative;
    /* Thiết lập lại margin để sơ đồ gọn hơn */
}

.tree-container ul ul {
    padding-left: 30px; /* Thụt lề lớn hơn cho nhánh con */
}

.tree-container ul li {
    position: relative;
    margin-bottom: 12px;
}

/* Đường kẻ ngang: Nối từ Node cha sang Node con */
.tree-container ul li:before {
    content: '';
    position: absolute;
    top: 24px; /* Căn giữa chiều cao thẻ mới (40px) */
    left: 0;
    border-top: 2px solid #D1D5DB; /* Màu xám nhạt */
    width: 30px; /* Khoảng cách từ đường dọc đến thẻ con */
    height: 0;
}

/* Đường kẻ dọc: Nối các Node ngang hàng (anh/chị/em) */
.tree-container ul ul li:after {
    content: '';
    position: absolute;
    left: -2px; /* Dịch sang trái để căn với đường ngang của cha */
    top: -16px; /* Bắt đầu từ phía trên node hiện tại */
    bottom: 0;
    border-left: 2px solid #D1D5DB; /* Màu xám nhạt */
    width: 0;
}

/* Điều chỉnh vị trí đường kẻ ngang cho Node cha (sau khi có đường kẻ dọc) */
.tree-container ul ul li:before {
    left: 0px;
    width: 30px; /* Độ dài đường ngang */
}

/* Cắt đường dọc ở node cuối cùng của mỗi nhánh để không kéo dài xuống */
.tree-container ul ul li:last-child:after {
    height: 40px; /* Chiều cao cố định để dừng ở thẻ node hiện tại */
}

/* Ẩn đường kẻ cho node gốc */
.tree-container .root-node > li:before,
.tree-container .root-node > li:first-child:after {
    display: none;
}
</style>
@endpush

@push('scripts')
<script>
    document.querySelectorAll('.toggle-children').forEach(btn => {
        btn.addEventListener('click', () => {
            // Tìm ul là phần tử con tiếp theo của li cha
            const listItem = btn.closest('li');
            if (!listItem) return;
            
            // Tìm UL chứa con (có thể là phần tử liền kề hoặc nằm trong cấu trúc phức tạp hơn)
            // Trong cấu trúc mới, nó là phần tử UL tiếp theo
            const childrenList = listItem.querySelector('ul'); 

            if (childrenList) {
                childrenList.classList.toggle('hidden');
                
                // Đổi biểu tượng
                const icon = btn.querySelector('svg');
                if (childrenList.classList.contains('hidden')) {
                    // Dấu cộng (đóng)
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />'; 
                } else {
                    // Dấu trừ (mở)
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />'; 
                }
            }
        });
    });
</script>
@endpush