<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nik')->nullable()->after('role');
            $table->string('position')->nullable()->after('nik');
            $table->date('birth_date')->nullable()->after('position');
            $table->text('address')->nullable()->after('birth_date');
            $table->string('photo')->nullable()->after('address');
        });

        // Backfill existing users with unique placeholder NIK
        $users = DB::table('users')->whereNull('nik')->orWhere('nik', '')->get();
        foreach ($users as $i => $user) {
            DB::table('users')->where('id', $user->id)->update([
                'nik' => str_pad((string) ($i + 1), 16, '0', STR_PAD_LEFT),
            ]);
        }

        // Now make it unique + not null
        Schema::table('users', function (Blueprint $table) {
            $table->string('nik')->nullable(false)->unique()->change();
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
