<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staffs';

    protected $fillable = ['name', 'position'];

    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }
}