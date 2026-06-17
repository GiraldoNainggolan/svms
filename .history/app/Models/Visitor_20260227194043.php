<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{

    Schema::create('visitors', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('phone');
    $table->string('institution')->nullable();
    $table->text('purpose');
    $table->string('status')->default('IN');
    $table->timestamp('checkin_time')->nullable();
    $table->timestamp('checkout_time')->nullable();
    $table->timestamps();
});
}
