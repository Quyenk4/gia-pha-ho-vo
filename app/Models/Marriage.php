<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marriage extends Model
{
    use HasFactory;

    protected $table = 'marriages';
    protected $primaryKey = 'MarriageID';

    protected $fillable = [
        'HusbandID', 'WifeID', 'MarriageDate', 'Status'
    ];

    public function husband()
    {
        return $this->belongsTo(Member::class, 'HusbandID');
    }

    public function wife()
    {
        return $this->belongsTo(Member::class, 'WifeID');
    }
}
