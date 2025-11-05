<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
 use App\Http\Controllers\RelationshipController;
 use App\Http\Controllers\FamilyTreeController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (YÊU CẦU ĐĂNG NHẬP)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Redirect gốc
    Route::get('/', fn() => redirect()->route('home'));

    // HOME
    Route::get('/home', function () {
        $stats = [
            'total_members' => 156,
            'generation' => 'IX',
            'upcoming_events' => 4,
            'birthdays' => 5,
        ];
        $activities = [
            ['action' => 'Thêm mới: Võ Văn B', 'detail' => 'Thế hệ IX', 'by' => 'Admin', 'time' => '5 phút trước'],
            ['action' => 'Cập nhật: Võ Thị C', 'detail' => 'Cập nhật địa chỉ', 'by' => 'Admin', 'time' => '1 giờ trước'],
            ['action' => 'Thêm sự kiện: Lễ giỗ tổ', 'detail' => 'Chuẩn bị lễ vật', 'by' => 'Admin', 'time' => 'Hôm qua'],
            ['action' => 'Thêm quan hệ: Võ Văn H là con của Võ Văn C', 'detail' => 'Quan hệ cha-con', 'by' => 'Admin', 'time' => 'Hôm qua'],
        ];
        $events = [
            ['title' => 'Giỗ Tổ Họ Võ', 'date' => '2025-11-20', 'type' => 'Giỗ', 'color' => 'orange'],
            ['title' => 'Sinh nhật: Võ Thị Lan', 'date' => '2025-10-25', 'type' => 'Sinh nhật', 'color' => 'blue'],
            ['title' => 'Kỷ niệm cưới: Ông T & Bà D', 'date' => '2025-11-05', 'type' => 'Kỷ niệm', 'color' => 'purple'],
            ['title' => 'Họp mặt Gia tộc', 'date' => '2025-12-30', 'type' => 'Họp mặt', 'color' => 'green'],
        ];
        return view('home', compact('stats', 'activities', 'events'));
    })->name('home');

    /*
    |--------------------------------------------------------------------------
    | MEMBERS
    |--------------------------------------------------------------------------
    */
    Route::resource('members', MemberController::class);

    /*
    |--------------------------------------------------------------------------
    | RELATIONS (Thiết lập quan hệ cha – con)
    |--------------------------------------------------------------------------
    */
  



Route::get('/relationships', [RelationshipController::class, 'index'])->name('relationships.index');
Route::post('/relationships', [RelationshipController::class, 'store'])->name('relationships.store');




    /*
    |--------------------------------------------------------------------------
    | FAMILY TREE
    |--------------------------------------------------------------------------
    */
 

Route::get('/family-tree', [FamilyTreeController::class, 'index'])->name('tree.index');


    /*
    |--------------------------------------------------------------------------
    | EVENTS
    |--------------------------------------------------------------------------
    */
    Route::get('/events', function () {
        $events = [
            ['id' => 1, 'title' => 'Giỗ Tổ Họ Võ', 'date' => '2025-11-20', 'type' => 'Giỗ', 'place' => 'Từ đường Chi III', 'note' => 'Chuẩn bị lễ vật'],
            ['id' => 2, 'title' => 'Sinh nhật: Võ Thị Lan', 'date' => '2025-10-25', 'type' => 'Sinh nhật', 'place' => 'Nhà riêng', 'note' => 'Không tổ chức lớn'],
            ['id' => 3, 'title' => 'Kỷ niệm cưới: Ông T & Bà D', 'date' => '2025-11-05', 'type' => 'Kỷ niệm', 'place' => 'Nhà khách', 'note' => 'Mời đại diện các chi'],
        ];
        return view('events.index', compact('events'));
    })->name('events.index');

    Route::get('/events/create', fn() => view('events.create'))->name('events.create');

    Route::get('/events/{id}', function ($id) {
        $events = [
            1 => ['id' => 1, 'title' => 'Giỗ Tổ Họ Võ', 'date' => '2025-11-20', 'type' => 'Giỗ', 'place' => 'Từ đường Chi III', 'note' => 'Chuẩn bị lễ vật'],
            2 => ['id' => 2, 'title' => 'Sinh nhật: Võ Thị Lan', 'date' => '2025-10-25', 'type' => 'Sinh nhật', 'place' => 'Nhà riêng', 'note' => 'Không tổ chức lớn'],
            3 => ['id' => 3, 'title' => 'Kỷ niệm cưới: Ông T & Bà D', 'date' => '2025-11-05', 'type' => 'Kỷ niệm', 'place' => 'Nhà khách', 'note' => 'Mời đại diện các chi'],
        ];
        $event = $events[$id] ?? null;
        if (!$event) abort(404);
        return view('events.show', compact('event'));
    })->name('events.show');

    /*
    |--------------------------------------------------------------------------
    | STATISTIC
    |--------------------------------------------------------------------------
    */
    Route::get('/statistic', function () {
        $stats = [
            'total_members' => 156,
            'male' => 90,
            'female' => 66,
            'by_generation' => ['I' => 3, 'II' => 5, 'III' => 12, 'IV' => 25, 'V' => 30, 'VI' => 30, 'VII' => 20, 'VIII' => 20, 'IX' => 11],
            'by_branch' => ['Huế' => 110, 'Đà Nẵng' => 25, 'SG' => 15, 'Quảng Nam' => 6]
        ];
        return view('statistic', compact('stats'));
    })->name('statistic.index');

    /*
    |--------------------------------------------------------------------------
    | PROFILE / SETTINGS / ACTIVITIES
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', fn() => view('profile'))->name('profile.index');
    Route::get('/settings', fn() => view('settings'))->name('settings.index');
    Route::get('/activities', fn() => view('activities.index'))->name('activities.index');
});
