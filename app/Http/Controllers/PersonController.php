<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Vẫn giữ lại để xóa file nếu cần
use Illuminate\Support\Facades\File; // Thêm File Facade
use Illuminate\Support\Str; // Thêm Str Facade để tạo tên file ngẫu nhiên

class PersonController extends Controller
{
    // Đường dẫn đích cố định trong thư mục public
    protected $destinationPath = 'images/members/'; 

    // 🧾 Danh sách tất cả thành viên
    public function index()
    {
        $members = Person::orderBy('PersonalID', 'asc')->paginate(12);

        return view('members.index', compact('members'));
    }

    // ➕ Form thêm mới
    public function create()
    {
        return view('members.create');
    }

    // 💾 Lưu thành viên mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Name' => 'required|string|max:100',
            'Gender' => 'nullable|in:Nam,Nữ',
            'BirthDate' => 'nullable|date',
            'DeathDate' => 'nullable|date',
            'BirthPlace' => 'nullable|string|max:150',
            'Generation' => 'nullable|string|max:20',
            'Email' => 'nullable|email|max:100',
            'Phone' => 'nullable|string|max:20',
            // Đổi tên trường từ PhotoUrl thành photo trong validate để đồng bộ với form
            'photo' => 'nullable|image|max:2048', 
        ]);

        $validated['PhotoUrl'] = null;

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            
            // 1. Tạo tên file ngẫu nhiên và an toàn
            $file_name = Str::random(20) . '.' . $image->getClientOriginalExtension();
            
            // 2. Xác định đường dẫn thư mục đích (public/images/members)
            $destination = public_path($this->destinationPath);

            // 3. Đảm bảo thư mục tồn tại
            if (!File::isDirectory($destination)) {
                File::makeDirectory($destination, 0777, true, true);
            }

            // 4. Di chuyển file vào thư mục đích
            $image->move($destination, $file_name);
            
            // 5. Lưu đường dẫn tuyệt đối (VD: /images/members/xyz.png) vào PhotoUrl
            $validated['PhotoUrl'] = '/' . $this->destinationPath . $file_name;
        }

        // Tạo bản ghi mới, sử dụng trường PhotoUrl đã được cập nhật
        Person::create($validated);

        return redirect()->route('members.index')->with('success', 'Thêm thành viên thành công!');
    }

    // 👁️ Xem chi tiết
    public function show(Person $member)
    {
        return view('members.show', compact('member'));
    }

    // ✏️ Form sửa
    public function edit(Person $member)
    {
        return view('members.edit', compact('member'));
    }

    // 🔁 Cập nhật thông tin
    public function update(Request $request, Person $member)
    {
        $validated = $request->validate([
            'Name' => 'required|string|max:100',
            'Gender' => 'nullable|in:Nam,Nữ',
            'BirthDate' => 'nullable|date',
            'DeathDate' => 'nullable|date',
            'BirthPlace' => 'nullable|string|max:150',
            'Generation' => 'nullable|string|max:20',
            'Email' => 'nullable|email|max:100',
            'Phone' => 'nullable|string|max:20',
            // Sử dụng 'photo'
            'photo' => 'nullable|image|max:2048', 
        ]);
        
        $currentPhotoUrl = $member->PhotoUrl; // Giữ lại đường dẫn cũ
        
        if ($request->hasFile('photo')) {
            // 1. XÓA ảnh cũ nếu có
            if ($currentPhotoUrl) {
                $oldFile = public_path(ltrim($currentPhotoUrl, '/'));
                if (File::exists($oldFile)) {
                    File::delete($oldFile);
                }
            }

            $image = $request->file('photo');
            $file_name = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $destination = public_path($this->destinationPath);
            
            // Di chuyển file mới
            $image->move($destination, $file_name);
            
            // Cập nhật đường dẫn mới cho bản ghi
            $validated['PhotoUrl'] = '/' . $this->destinationPath . $file_name;
        } else {
            // Nếu không upload ảnh mới, giữ nguyên ảnh cũ
            unset($validated['photo']); // Loại bỏ photo khỏi validated data
            $validated['PhotoUrl'] = $currentPhotoUrl;
        }
        
        // Cập nhật bản ghi, Laravel sẽ tự động sử dụng PhotoUrl đã được tính toán
        $member->update($validated);

        return redirect()->route('members.index')->with('success', 'Cập nhật thành viên thành công!');
    }

    // ❌ Xóa
    public function destroy(Person $member)
    {
        // Xóa tệp ảnh vật lý
        if ($member->PhotoUrl) {
            $fileToDelete = public_path(ltrim($member->PhotoUrl, '/'));
            if (File::exists($fileToDelete)) {
                File::delete($fileToDelete);
            }
        }

        $member->delete();

        return redirect()->route('members.index')->with('success', 'Đã xóa thành viên!');
    }
}