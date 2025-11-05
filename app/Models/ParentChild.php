<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentChild extends Model
{
    use HasFactory;

    protected $table = 'parent_child';
    protected $primaryKey = 'RelationID';
    protected $fillable = ['ParentID', 'ChildID', 'RelationType'];

    public function parent()
    {
        return $this->belongsTo(Member::class, 'ParentID', 'PersonalID');
    }

    public function child()
    {
        return $this->belongsTo(Member::class, 'ChildID', 'PersonalID');
    }
}
