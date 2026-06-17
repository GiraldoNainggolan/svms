<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string|null $phone
 * @property string|null $institution
 * @property int|null $staff_id
 * @property string $purpose
 * @property string|null $photo
 * @property string|null $signature_path
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $checkin_time
 * @property \Illuminate\Support\Carbon|null $checkout_time
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\User|null $staff
 */
class Visitor extends Model
{
    // ── Status workflow constants ─────────────────────
    public const STATUS_WAITING  = 'WAITING';
    public const STATUS_ACCEPTED = 'ACCEPTED';
    public const STATUS_REJECTED = 'REJECTED';
    public const STATUS_IN       = 'IN';
    public const STATUS_OUT      = 'OUT';

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
        return $this->belongsTo(User::class, 'staff_id');
    }
}
