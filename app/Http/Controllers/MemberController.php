<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    /**
     * Hiển thị danh sách thành viên (có phân trang)
     */
   public function index()
{
  $members = Member::with([
    'father',
    'mother',
    'marriagesAsHusband.wife',
    'marriagesAsWife.husband'
])
->orderBy('Generation', 'asc')
->paginate(10);


    return view('members.index', compact('members'));
}


    /**
     * Hiển thị form thêm thành viên mới
     */
    public function create()
    {
        // Lấy danh sách tất cả thành viên hiện có để chọn cha/mẹ
        $people = Member::orderBy('FullName', 'asc')->get();

        return view('members.create', compact('people'));
    }

    /**
     * Lưu thành viên mới
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
    'FullName' => 'required|string|max:255',
    'Gender' => 'required|in:Nam,Nữ,Khác',
    'DateOfBirth' => 'nullable|date',
    'DateOfDeath' => 'nullable|date|after:DateOfBirth',
    'PlaceOfBirth' => 'nullable|string|max:255',
    'CurrentAddress' => 'nullable|string|max:255',
    'Occupation' => 'nullable|string|max:255',
    'Phone' => 'nullable|string|max:50',
    'Email' => 'nullable|email|max:255',
    'Biography' => 'nullable|string',
    'Generation' => 'nullable|integer|min:1|max:20',
    'Avatar' => 'nullable|image|max:2048',
    'FatherID' => 'nullable|integer|exists:people,PersonalID',
    'MotherID' => 'nullable|integer|exists:people,PersonalID',
    'SpouseID' => 'nullable|integer|exists:people,PersonalID',
]);

        // Upload ảnh nếu có
        if ($request->hasFile('Avatar')) {
            $path = $request->file('Avatar')->store('avatars', 'public');
            $validated['Avatar'] = $path;
        }

        // Gán mặc định FamilyID = 1
       

        Member::create($validated);

        return redirect()->route('members.index')->with('success', 'Thêm thành viên thành công!');
    }

    /**
     * Hiển thị chi tiết thành viên
     */
public function show($id)
{
    $member = Member::with([
        'father',
        'mother',
        'children',
        'marriagesAsHusband.wife',
        'marriagesAsWife.husband'
    ])->findOrFail($id);

    return view('members.show', compact('member'));
}


    /**
     * Hiển thị form chỉnh sửa
     */
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        $people = Member::orderBy('FullName', 'asc')->get();

        return view('members.edit', compact('member', 'people'));
    }

    /**
     * Cập nhật thông tin thành viên
     */
    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

       $validated = $request->validate([
    'FullName' => 'required|string|max:255',
    'Gender' => 'required|in:Nam,Nữ,Khác',
    'DateOfBirth' => 'nullable|date',
    'DateOfDeath' => 'nullable|date|after:DateOfBirth',
    'PlaceOfBirth' => 'nullable|string|max:255',
    'CurrentAddress' => 'nullable|string|max:255',
    'Occupation' => 'nullable|string|max:255',
    'Phone' => 'nullable|string|max:50',
    'Email' => 'nullable|email|max:255',
    'Biography' => 'nullable|string',
    'Generation' => 'nullable|integer|min:1|max:20',
    'Avatar' => 'nullable|image|max:2048',
    'FatherID' => 'nullable|integer|exists:people,PersonalID',
    'MotherID' => 'nullable|integer|exists:people,PersonalID',
    'SpouseID' => 'nullable|integer|exists:people,PersonalID',
]);


        // Nếu có upload ảnh mới → thay thế ảnh cũ
        if ($request->hasFile('Avatar')) {
            // Xóa ảnh cũ (nếu có)
            if ($member->Avatar && Storage::disk('public')->exists($member->Avatar)) {
                Storage::disk('public')->delete($member->Avatar);
            }

            $path = $request->file('Avatar')->store('avatars', 'public');
            $validated['Avatar'] = $path;
        }

        $member->update($validated);

        return redirect()->route('members.index')->with('success', 'Cập nhật thành viên thành công!');
    }

    /**
     * Xóa thành viên
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id);

        // Xóa ảnh đại diện nếu có
        if ($member->Avatar && Storage::disk('public')->exists($member->Avatar)) {
            Storage::disk('public')->delete($member->Avatar);
        }

        $member->delete();

        return redirect()->route('members.index')->with('success', 'Xóa thành viên thành công!');
    }
}
