<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Mock routes for FE demo (no backend required)
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => redirect('/home'));

// HOME (mock data)
Route::get('/home', function(){
    $stats = [
        'total_members' => 156,
        'generation' => 'IX',
        'upcoming_events' => 4,
        'birthdays' => 5,
    ];

    $activities = [
        ['action'=>'Thêm mới: Võ Văn B','detail'=>'Thế hệ IX','by'=>'Admin','time'=>'5 phút trước'],
        ['action'=>'Cập nhật: Võ Thị C','detail'=>'Cập nhật địa chỉ','by'=>'Admin','time'=>'1 giờ trước'],
        ['action'=>'Thêm sự kiện: Lễ giỗ tổ','detail'=>'Chuẩn bị lễ vật','by'=>'Admin','time'=>'Hôm qua'],
        ['action'=>'Thêm quan hệ: Võ Văn H là con của Võ Văn C','detail'=>'Quan hệ cha-con','by'=>'Admin','time'=>'Hôm qua'],
    ];

    $events = [
        ['title'=>'Giỗ Tổ Họ Võ','date'=>'2025-11-20','type'=>'Giỗ','color'=>'orange'],
        ['title'=>'Sinh nhật: Võ Thị Lan','date'=>'2025-10-25','type'=>'Sinh nhật','color'=>'blue'],
        ['title'=>'Kỷ niệm cưới: Ông T & Bà D','date'=>'2025-11-05','type'=>'Kỷ niệm','color'=>'purple'],
        ['title'=>'Họp mặt Gia tộc','date'=>'2025-12-30','type'=>'Họp mặt','color'=>'green'],
    ];

    return view('home', compact('stats','activities','events'));
})->name('home');

/*
| Members (mock list / show / create / edit)
*/
Route::get('/members', function(){
    $members = [];
    for($i=1;$i<=20;$i++){
        $members[] = [
            'id'=>$i,
            'name'=> ($i%2? "Võ Văn $i":"Võ Thị $i"),
            'gender'=> $i%2 ? 'Nam' : 'Nữ',
            'birthday'=> date('Y-m-d', strtotime("-".(20+$i)." years")),
            'branch'=> $i%3==0 ? 'Đà Nẵng' : 'Huế',
            'generation'=> ($i%9)+1,
            'photo'=> '/images/members/ps.jpg'
        ];
    }
    return view('members.index', compact('members'));
})->name('members.index');

Route::get('/members/create', fn() => view('members.create'))->name('members.create');

Route::get('/members/{id}', function($id){
    $member = [
        'id'=>$id,
        'name'=> ($id%2? "Võ Văn $id":"Võ Thị $id"),
        'gender'=> $id%2 ? 'Nam' : 'Nữ',
        'birthday'=> date('Y-m-d', strtotime("-".(20+$id)." years")),
        'branch'=> $id%3==0 ? 'Đà Nẵng' : 'Huế',
        'generation'=> ($id%9)+1,
        'birthplace'=>'Phú Vang, Thừa Thiên Huế',
        'father'=>'Võ Văn X',
        'mother'=>'Trần Thị Y',
        'photo'=>'/images/default-avatar.png',
        'bio'=>'Thành viên thuộc chi III, hoạt động tích cực trong các sự kiện gia tộc.'
    ];
    return view('members.show', compact('member'));
})->name('members.show');

Route::get('/members/{id}/edit', function($id){
    $member = [
        'id'=>$id,
        'name'=> ($id%2? "Võ Văn $id":"Võ Thị $id"),
        'gender'=> $id%2 ? 'Nam' : 'Nữ',
        'birthday'=> date('Y-m-d', strtotime("-".(20+$id)." years")),
        'branch'=> $id%3==0 ? 'Đà Nẵng' : 'Huế',
        'generation'=> ($id%9)+1,
        'birthplace'=>'Phú Vang, Thừa Thiên Huế',
    ];
    return view('members.edit', compact('member'));
})->name('members.edit');

/*
| Tree
*/
Route::get('/tree', function(){
    // simple nested tree mock (array)
    $tree = [
        ['id'=>1,'name'=>'Cụ Tổ Võ Văn K (I)','children'=>[
            ['id'=>2,'name'=>'Võ Văn A (II)','children'=>[
                ['id'=>4,'name'=>'Võ Văn B (III)'],
                ['id'=>5,'name'=>'Võ Thị C (III)'],
            ]],
            ['id'=>3,'name'=>'Võ Văn D (II)','children'=>[
                ['id'=>6,'name'=>'Võ Văn E (III)'],
            ]],
        ]]
    ];
    return view('tree.index', compact('tree'));
})->name('tree.index');

/*
| Events
*/
Route::get('/events', function(){
    $events = [
        ['id'=>1,'title'=>'Giỗ Tổ Họ Võ','date'=>'2025-11-20','type'=>'Giỗ','place'=>'Từ đường Chi III','note'=>'Chuẩn bị lễ vật'],
        ['id'=>2,'title'=>'Sinh nhật: Võ Thị Lan','date'=>'2025-10-25','type'=>'Sinh nhật','place'=>'Nhà riêng','note'=>'Không tổ chức lớn'],
        ['id'=>3,'title'=>'Kỷ niệm cưới: Ông T & Bà D','date'=>'2025-11-05','type'=>'Kỷ niệm','place'=>'Nhà khách','note'=>'Mời đại diện các chi'],
    ];
    return view('events.index', compact('events'));
})->name('events.index');

Route::get('/events/create', fn() => view('events.create'))->name('events.create');

Route::get('/events/{id}', function($id){
    $events = [
        1=>['id'=>1,'title'=>'Giỗ Tổ Họ Võ','date'=>'2025-11-20','type'=>'Giỗ','place'=>'Từ đường Chi III','note'=>'Chuẩn bị lễ vật'],
        2=>['id'=>2,'title'=>'Sinh nhật: Võ Thị Lan','date'=>'2025-10-25','type'=>'Sinh nhật','place'=>'Nhà riêng','note'=>'Không tổ chức lớn'],
        3=>['id'=>3,'title'=>'Kỷ niệm cưới: Ông T & Bà D','date'=>'2025-11-05','type'=>'Kỷ niệm','place'=>'Nhà khách','note'=>'Mời đại diện các chi'],
    ];
    $event = $events[$id] ?? null;
    if(!$event) abort(404);
    return view('events.show', compact('event'));
})->name('events.show');

/*
| Statistic
*/
Route::get('/statistic', function(){
    $stats = [
        'total_members'=>156,
        'male'=>90,
        'female'=>66,
        'by_generation'=>['I'=>3,'II'=>5,'III'=>12,'IV'=>25,'V'=>30,'VI'=>30,'VII'=>20,'VIII'=>20,'IX'=>11],
        'by_branch'=>['Huế'=>110,'Đà Nẵng'=>25,'SG'=>15,'Quảng Nam'=>6]
    ];
    return view('statistic', compact('stats'));
})->name('statistic.index');

/*
| Profile / settings / activities
*/
Route::get('/profile', fn() => view('profile'))->name('profile.index');
Route::get('/settings', fn() => view('settings'))->name('settings.index');
Route::get('/activities', fn() => view('activities.index'))->name('activities.index');

/*
| Auth (login page)
*/
Route::get('/login', fn() => view('auth.login'))->name('login');
