<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\DB;

class FamilyTreeController extends Controller
{
    public function index()
    {
        // 1. Lấy tất cả thành viên với các trường cơ bản
        $members = Member::all(['PersonalID', 'FullName', 'Gender', 'Avatar']);

        // 2. Lấy tất cả quan hệ cha-con và hôn nhân
        $parentChildRelations = DB::table('parent_child')->get();
        $marriages = DB::table('marriage')->get();

        // 3. Tạo dữ liệu cây phẳng (Flat Tree Data)
        $treeData = $members->map(function ($member) use ($parentChildRelations, $marriages) {
            $memberId = $member->PersonalID;

            // --- Xử lý Cha/Mẹ ---
            $parentRelation = $parentChildRelations->firstWhere('child_id', $memberId);
            $parentId = $parentRelation ? $parentRelation->parent_id : null;

            // --- Xử lý Vợ/Chồng ---
            $marriageRelation = $marriages->first(function ($rel) use ($memberId) {
                return $rel->husband_id == $memberId || $rel->wife_id == $memberId;
            });
            $partnerId = null;
            if ($marriageRelation) {
                $partnerId = ($marriageRelation->husband_id == $memberId)
                    ? $marriageRelation->wife_id
                    : $marriageRelation->husband_id;
            }

            // --- Trả về node cho cây ---
            return [
                'id' => $memberId,
                'pid' => $parentId,
                'partner_id' => $partnerId,
                'name' => $member->FullName,
                'title' => $member->Gender, // Dùng enum Nam/Nữ/Khác
                'img' => $member->Avatar ? asset('uploads/' . $member->Avatar) : asset('images/default.png'),
                'tags' => [], // Không dùng FamilyName
            ];
        })
        ->filter(fn($node) => !empty($node['id'])) // loại bỏ node rỗng
        ->toArray();

        // 4. Trả dữ liệu cho view
        return view('family.tree', compact('treeData'));
    }
}
