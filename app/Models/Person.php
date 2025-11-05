<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'people';
    protected $primaryKey = 'PersonalID';
    public $timestamps = false;

    protected $fillable = ['Name', 'Gender', 'BirthDate', 'SpouseID'];

    public function parents()
    {
        return $this->belongsToMany(Person::class, 'parent_child', 'ChildID', 'ParentID');
    }

   public function children()
{
    return $this->belongsToMany(Person::class, 'parent_child', 'ParentID', 'ChildID');
}


    public function spouse()
    {
        return $this->belongsTo(Person::class, 'SpouseID');
    }
}
