<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'description',
        'target_type',
        'target_id',
        'ip_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Quick helper to log an activity.
     */
    public static function log(string $action, string $description, $target = null): self
    {
        return static::create([
            'user_id'     => auth()->id(),
            'action'      => $action,
            'description' => $description,
            'target_type' => $target ? get_class($target) : null,
            'target_id'   => $target?->id,
            'ip_address'  => request()->ip(),
        ]);
    }
}
