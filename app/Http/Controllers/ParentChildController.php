<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\ParentChild;
use Illuminate\Support\Facades\DB;

class ParentChildController extends Controller
{
    /**
     * Hiển thị danh sách thành viên và quan hệ.
     */
    public function index()
    {
        $members = Person::with(['parents', 'children', 'spouse'])->get();
        return view('relations.index', compact('members'));
    }

    /**
     * Form tạo quan hệ cha/mẹ - con.
     */
    public function create()
    {
        $members = Person::all();
        return view('relations.create', compact('members'));
    }

    /**
     * Lưu quan hệ mới vào bảng parent_child.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ParentID' => 'required|different:ChildID',
            'ChildID'  => 'required',
            'RelationshipType' => 'required|string',
        ], [
            'ParentID.required' => 'Vui lòng chọn người cha/mẹ.',
            'ChildID.required'  => 'Vui lòng chọn người con.',
            'ParentID.different' => 'Cha/Mẹ không thể trùng với Con.',
        ]);

        ParentChild::create([
            'ParentID' => $request->ParentID,
            'ChildID' => $request->ChildID,
            'RelationshipType' => $request->RelationshipType,
        ]);

        return redirect()->route('relations.index')->with('success', 'Thiết lập quan hệ thành công!');
    }

    /**
     * Xoá một quan hệ cha – con.
     */
    public function destroy($id)
    {
        $relation = ParentChild::findOrFail($id);
        $relation->delete();

        return redirect()->route('relations.index')->with('success', 'Đã xoá quan hệ thành công.');
    }
}
