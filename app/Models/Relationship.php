<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    use HasFactory;

    protected $table = 'relationships'; // hoặc 'relations' nếu bạn đặt tên vậy
    protected $fillable = ['Person1_ID', 'Person2_ID', 'relation_type', 'status'];

    // Vợ/chồng
    public function husband()
    {
        return $this->belongsTo(Member::class, 'Person1_ID');
    }

    public function wife()
    {
        return $this->belongsTo(Member::class, 'Person2_ID');
    }
}
