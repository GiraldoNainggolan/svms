<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string|null $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Staff extends Model
{
    protected $table = 'staffs';

    protected $fillable = ['name', 'position'];

    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }
}
