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
        'signature',
        'status',
        'checkin_time',
        'checkout_time',
    ];
}