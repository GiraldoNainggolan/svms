<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'institution',
        'staff_id',
        'purpose',
        'photo',
        'signature_path',
        'status',
        'checkin_time',
        'checkout_time',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
