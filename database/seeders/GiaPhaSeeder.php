<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GiaPhaSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // Tắt kiểm tra khóa ngoại khi xóa dữ liệu
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('event_people')->truncate();
        DB::table('events')->truncate();
        DB::table('event_types')->truncate();
        DB::table('marriages')->truncate();
        DB::table('parent_child')->truncate();
        DB::table('statistics')->truncate();
        DB::table('people')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ======== 1️⃣ THÀNH VIÊN ========
        DB::table('people')->insert([
            // Đời 1
            ['PersonalID' => 1, 'FullName' => 'Võ Văn Lộc', 'Gender' => 'Nam', 'DateOfBirth' => '1940-05-10', 'PlaceOfBirth' => 'Huế', 'Occupation' => 'Nông dân', 'Generation' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['PersonalID' => 2, 'FullName' => 'Nguyễn Thị Hoa', 'Gender' => 'Nữ', 'DateOfBirth' => '1945-03-12', 'PlaceOfBirth' => 'Huế', 'Occupation' => 'Nội trợ', 'Generation' => 1, 'created_at' => $now, 'updated_at' => $now],

            // Đời 2
            ['PersonalID' => 3, 'FullName' => 'Võ Văn An', 'Gender' => 'Nam', 'DateOfBirth' => '1965-06-20', 'PlaceOfBirth' => 'Huế', 'Occupation' => 'Giáo viên', 'Generation' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['PersonalID' => 4, 'FullName' => 'Trần Thị Mai', 'Gender' => 'Nữ', 'DateOfBirth' => '1968-09-22', 'PlaceOfBirth' => 'Huế', 'Occupation' => 'Kế toán', 'Generation' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['PersonalID' => 5, 'FullName' => 'Võ Thị Lan', 'Gender' => 'Nữ', 'DateOfBirth' => '1970-02-10', 'PlaceOfBirth' => 'Huế', 'Occupation' => 'Y tá', 'Generation' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['PersonalID' => 6, 'FullName' => 'Phan Văn Minh', 'Gender' => 'Nam', 'DateOfBirth' => '1966-11-15', 'PlaceOfBirth' => 'Huế', 'Occupation' => 'Kỹ sư xây dựng', 'Generation' => 2, 'created_at' => $now, 'updated_at' => $now],

            // Đời 3
            ['PersonalID' => 7, 'FullName' => 'Võ Thị Hương', 'Gender' => 'Nữ', 'DateOfBirth' => '1990-01-05', 'PlaceOfBirth' => 'Huế', 'Occupation' => 'Nhân viên ngân hàng', 'Generation' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['PersonalID' => 8, 'FullName' => 'Nguyễn Văn Nam', 'Gender' => 'Nam', 'DateOfBirth' => '1988-07-22', 'PlaceOfBirth' => 'Đà Nẵng', 'Occupation' => 'Lập trình viên', 'Generation' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['PersonalID' => 9, 'FullName' => 'Võ Minh Tuấn', 'Gender' => 'Nam', 'DateOfBirth' => '1992-08-10', 'PlaceOfBirth' => 'Huế', 'Occupation' => 'Sinh viên', 'Generation' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['PersonalID' => 10, 'FullName' => 'Trần Thị Mỹ', 'Gender' => 'Nữ', 'DateOfBirth' => '1995-09-15', 'PlaceOfBirth' => 'Huế', 'Occupation' => 'Bác sĩ', 'Generation' => 3, 'created_at' => $now, 'updated_at' => $now],

            // Mồ côi
            ['PersonalID' => 11, 'FullName' => 'Lê Văn Bảo', 'Gender' => 'Nam', 'DateOfBirth' => '2000-12-01', 'PlaceOfBirth' => 'Huế', 'Occupation' => 'Thợ mộc', 'Generation' => 3, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // ======== 2️⃣ QUAN HỆ CHA – MẸ – CON ========
        DB::table('parent_child')->insert([
            // Cha mẹ - con (đủ)
            ['ParentID' => 1, 'ChildID' => 3, 'RelationType' => 'Cha Mẹ - Con'],
            ['ParentID' => 2, 'ChildID' => 3, 'RelationType' => 'Cha Mẹ - Con'],
            ['ParentID' => 1, 'ChildID' => 5, 'RelationType' => 'Cha Mẹ - Con'],
            ['ParentID' => 2, 'ChildID' => 5, 'RelationType' => 'Cha Mẹ - Con'],

            // Chỉ cha - con
            ['ParentID' => 3, 'ChildID' => 7, 'RelationType' => 'Cha - Con'],

            // Chỉ mẹ - con
            ['ParentID' => 4, 'ChildID' => 9, 'RelationType' => 'Mẹ - Con'],

            // Mồ côi
            ['ParentID' => null, 'ChildID' => 11, 'RelationType' => 'Mồ côi'],
        ]);

        // ======== 3️⃣ HÔN NHÂN ========
        DB::table('marriages')->insert([
            ['HusbandID' => 1, 'WifeID' => 2, 'MarriageDate' => '1963-04-12', 'Status' => 'Mất vợ', 'created_at' => $now, 'updated_at' => $now],
            ['HusbandID' => 3, 'WifeID' => 4, 'MarriageDate' => '1989-09-01', 'Status' => 'Đang sống chung', 'created_at' => $now, 'updated_at' => $now],
            ['HusbandID' => 6, 'WifeID' => 5, 'MarriageDate' => '1990-03-15', 'Status' => 'Ly hôn', 'created_at' => $now, 'updated_at' => $now],
            ['HusbandID' => 8, 'WifeID' => 7, 'MarriageDate' => '2015-05-20', 'Status' => 'Mất chồng', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // ======== 4️⃣ LOẠI SỰ KIỆN ========
        DB::table('event_types')->insert([
            ['EventTypeID' => 1, 'TypeName' => 'Giỗ tổ', 'Description' => 'Ngày tưởng nhớ tổ tiên', 'created_at' => $now, 'updated_at' => $now],
            ['EventTypeID' => 2, 'TypeName' => 'Họp mặt gia đình', 'Description' => 'Gặp gỡ toàn gia', 'created_at' => $now, 'updated_at' => $now],
            ['EventTypeID' => 3, 'TypeName' => 'Lễ cưới', 'Description' => 'Sự kiện kết hôn', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // ======== 5️⃣ SỰ KIỆN ========
        DB::table('events')->insert([
            ['EventID' => 1, 'EventTypeID' => 1, 'Title' => 'Giỗ cụ Võ Văn Lộc', 'Description' => 'Tổ chức tại nhà thờ họ Võ', 'EventDate' => '2024-04-15', 'Location' => 'Huế', 'created_at' => $now, 'updated_at' => $now],
            ['EventID' => 2, 'EventTypeID' => 2, 'Title' => 'Họp mặt họ Võ đầu năm', 'Description' => 'Gặp mặt đầu năm tại nhà ông An', 'EventDate' => '2025-02-10', 'Location' => 'Huế', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // ======== 6️⃣ NGƯỜI THAM GIA SỰ KIỆN ========
        DB::table('event_people')->insert([
            ['EventID' => 1, 'PersonalID' => 1, 'Role' => 'Người được tưởng nhớ', 'created_at' => $now, 'updated_at' => $now],
            ['EventID' => 2, 'PersonalID' => 3, 'Role' => 'Chủ trì', 'created_at' => $now, 'updated_at' => $now],
            ['EventID' => 2, 'PersonalID' => 4, 'Role' => 'Khách mời', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // ======== 7️⃣ THỐNG KÊ ========
        DB::table('statistics')->insert([
            [
                'TotalMembers' => 11,
                'MaleCount' => 6,
                'FemaleCount' => 5,
                'TotalMarriages' => 4,
                'TotalEvents' => 2,
                'LastUpdated' => $now,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
