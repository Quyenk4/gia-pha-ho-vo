<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Marriage;
use App\Models\ParentChild;

class RelationshipController extends Controller
{
    /**
     * Hiển thị danh sách và form thêm quan hệ
     */
    public function index()
    {
        $people = Person::orderBy('FullName')->get();
        $marriages = Marriage::with(['husband', 'wife'])->get();
        $relations = ParentChild::with(['parent', 'child'])->get();

        return view('relationships.index', compact('people', 'marriages', 'relations'));
    }

    /**
     * Lưu quan hệ mới
     */
    public function store(Request $request)
    {
        $type = $request->relation_type;

        // ------------------------------
        // 1️⃣ Quan hệ HÔN NHÂN
        // ------------------------------
        if ($type === 'marriage') {
            $request->validate([
                'husband_id' => 'required|different:wife_id',
                'wife_id' => 'required|different:husband_id',
                'marriage_date' => 'required|date',
                'status' => 'required|string|in:Đang sống chung,Ly hôn,Mất vợ,Mất chồng',
            ], [
                'husband_id.required' => 'Vui lòng chọn chồng.',
                'wife_id.required' => 'Vui lòng chọn vợ.',
                'marriage_date.required' => 'Vui lòng nhập ngày kết hôn.',
                'status.in' => 'Trạng thái không hợp lệ.',
            ]);

            Marriage::create([
                'HusbandID' => $request->husband_id,
                'WifeID' => $request->wife_id,
                'MarriageDate' => $request->marriage_date,
                'Status' => $request->status,
            ]);

            return redirect()->back()->with('success', 'Đã thêm quan hệ hôn nhân thành công!');
        }

        // ------------------------------
        // 2️⃣ Quan hệ CHA/MẸ - CON
        // ------------------------------
        if ($type === 'parent_child') {
            $request->validate([
                'child_id' => 'required',
                'relation_type_detail' => 'required|in:Cha - Con,Mẹ - Con,Cha Mẹ - Con,Mồ côi',
            ], [
                'child_id.required' => 'Vui lòng chọn con.',
                'relation_type_detail.in' => 'Loại quan hệ không hợp lệ.',
            ]);

            // Nếu là mồ côi thì không cần parent
            $parentId = null;
            if ($request->relation_type_detail !== 'Mồ côi') {
                $parentId = $request->father_id ?? $request->mother_id;
            }

            ParentChild::create([
                'ParentID' => $parentId,
                'ChildID' => $request->child_id,
                'RelationType' => $request->relation_type_detail,
            ]);

            return redirect()->back()->with('success', 'Đã thêm quan hệ cha/mẹ - con thành công!');
        }

        // ------------------------------
        // 3️⃣ Không chọn loại hợp lệ
        // ------------------------------
        return redirect()->back()->with('error', 'Vui lòng chọn loại quan hệ hợp lệ.');
    }
}
