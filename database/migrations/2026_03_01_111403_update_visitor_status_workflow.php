<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /**
     * Expand visitor status workflow:
     *   WAITING  → visitor just checked in, awaiting staff decision
     *   ACCEPTED → staff approved the visit
     *   REJECTED → staff declined the visit
     *   IN       → visitor is on-site (accepted by staff)
     *   OUT      → visitor has left (checked out by security)
     *
     * The column is already a VARCHAR — we just update the default
     * and convert existing 'IN' records (which were auto-assigned at kiosk)
     * to 'WAITING' so they respect the new workflow.
     */
    public function up(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->string('status')->default('WAITING')->change();
        });

        // Existing visitors that are 'IN' but never went through
        // staff approval should be left as-is (backward compat).
    }

    public function down(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->string('status')->default('IN')->change();
        });
    }
};
