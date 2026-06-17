<?php

require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

$cols = ['photo', 'address', 'birth_date', 'position', 'nik'];

foreach ($cols as $col) {
    if (Schema::hasColumn('users', $col)) {
        Schema::table('users', function (Blueprint $table) use ($col) {
            $table->dropColumn($col);
        });
        echo "Dropped: {$col}\n";
    } else {
        echo "Not found: {$col}\n";
    }
}

echo "DONE\n";
