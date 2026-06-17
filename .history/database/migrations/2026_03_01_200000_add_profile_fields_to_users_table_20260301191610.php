<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nik')->unique()->after('role');
            $table->string('position')->nullable()->after('nik');
            $table->date('birth_date')->nullable()->after('position');
            $table->text('address')->nullable()->after('birth_date');
            $table->string('photo')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nik', 'position', 'birth_date', 'address', 'photo']);
        });
    }
};
