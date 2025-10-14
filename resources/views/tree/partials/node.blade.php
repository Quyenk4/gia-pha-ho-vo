@php
    // Giả định $node có key 'gender' ('male', 'female') và 'generation' (số thế hệ)
    
    $is_male = !empty($node['gender']) && $node['gender'] == 'male';
    
    // Thiết lập màu sắc theo Giới tính (Tông ấm)
    $base_color = $is_male ? 'blue' : 'pink'; // Nam: Xanh, Nữ: Hồng nhạt

    // Giả định có thông tin người đã khuất
    $is_dead = !empty($node['is_dead']); 
    
    // Icon Giới tính
    $gender_icon = $is_male 
        ? '<svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3M8 10a4 4 0 11-8 0 4 4 0 018 0zM12 14h1v8m-4-8h-1v8"/></svg>' // Nam
        : '<svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 10a6 6 0 11-12 0 6 6 0 0112 0zM12 16v6m3-3H9"/></svg>'; // Nữ

    // Lấy thế hệ
    $generation_roman = $node['generation'] ?? 0;
@endphp

<li class="mb-2">
    <div class="flex items-start gap-1 node-wrapper">
        
        {{-- Nút Mở/Đóng (Toggle) --}}
        @if(!empty($node['children']))
            <button class="toggle-children flex-shrink-0 mt-2 w-6 h-6 flex items-center justify-center rounded-full bg-gray-200 hover:bg-gray-300 text-gray-700 transition duration-150 shadow-sm" title="Mở/Đóng nhánh">
                {{-- Icon trừ mặc định (Mở) --}}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" /></svg>
            </button>
        @else
            {{-- Khoảng trống giả (Placeholder) --}}
            <div class="flex-shrink-0 w-6"></div>
        @endif
        
        {{-- Thẻ Thành viên (Modern Card Design) --}}
        <div class="inline-flex items-center p-2 px-4 rounded-lg shadow-md flex-1 min-w-56 max-w-xs
                    bg-white hover:bg-{{ $base_color }}-50 
                    border-l-4 border-{{ $base_color }}-400 text-gray-800 transition duration-200 cursor-pointer hover:shadow-lg">
            
            <span class="flex-shrink-0 mr-3">{!! $gender_icon !!}</span>

            <span class="font-bold text-sm whitespace-nowrap overflow-hidden text-ellipsis mr-2 
                         {{ $is_dead ? 'line-through text-gray-500 italic' : 'text-gray-800' }}">
                {{ $node['name'] }} 
            </span>

            {{-- Hiển thị Thế hệ ở cuối --}}
            <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-gray-100 text-gray-600 ml-auto flex-shrink-0">
                T{{ $generation_roman }}
            </span>
            
            @if ($is_dead)
                <span class="ml-2 text-xs text-red-500 font-bold">†</span>
            @endif
        </div>
        
    </div>

    {{-- Phần con (Children) --}}
    @if(!empty($node['children']))
        <ul class="mt-2">
            @foreach($node['children'] as $child)
                {{-- Tăng cấp độ lên 1 --}}
                @include('tree.partials.node', ['node' => $child, 'level' => $level + 1])
            @endforeach
        </ul>
    @endif
</li>