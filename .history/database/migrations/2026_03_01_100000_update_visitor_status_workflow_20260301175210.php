<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Expand visitor status to support full workflow:
     * IN → WAITING → ACCEPTED / REJECTED → OUT
     *
     * Existing 'IN' and 'OUT' values remain valid.
     * The column is already a string, so no type change needed —
     * we just update existing 'IN' records to 'WAITING' where a staff_id exists.
     */
    public function up(): void
    {
        // No schema change needed — status is already a VARCHAR.
        // Seed existing IN visitors who have a staff_id to WAITING status
        // so the new flow works immediately.
        \App\Models\Visitor::where('status', 'IN')
            ->whereNotNull('staff_id')
            ->update(['status' => 'WAITING']);
    }

    public function down(): void
    {
        \App\Models\Visitor::whereIn('status', ['WAITING', 'ACCEPTED', 'REJECTED'])
            ->update(['status' => 'IN']);
    }
};
