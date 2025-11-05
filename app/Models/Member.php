<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'people';
    protected $primaryKey = 'PersonalID';
    public $timestamps = true;

    protected $fillable = [
        'FullName', 'Gender', 'DateOfBirth', 'DateOfDeath',
        'PlaceOfBirth', 'CurrentAddress', 'Occupation',
        'Phone', 'Email', 'Biography', 'Generation', 'Avatar',
        'FatherID', 'MotherID', 'SpouseID'
    ];



    // ==============================
    // QUAN HỆ HÔN NHÂN
    // ==============================

    public function marriagesAsHusband()
    {
        return $this->hasMany(Marriage::class, 'HusbandID', 'PersonalID');
    }

    public function marriagesAsWife()
    {
        return $this->hasMany(Marriage::class, 'WifeID', 'PersonalID');
    }

    // ==============================
// QUAN HỆ CHA - MẸ - CON
// ==============================

public function parents()
{
    return $this->belongsToMany(
        Member::class,
        'parent_child',
        'ChildID',  // cột chứa ID của con
        'ParentID'  // cột chứa ID của cha/mẹ
    );
}

public function father()
{
    return $this->parents()->where('Gender', 'Nam');
}

public function mother()
{
    return $this->parents()->where('Gender', 'Nữ');
}

public function children()
{
    return $this->belongsToMany(
        Member::class,
        'parent_child',
        'ParentID', // ID của cha/mẹ
        'ChildID'   // ID của con
    );
}
}
