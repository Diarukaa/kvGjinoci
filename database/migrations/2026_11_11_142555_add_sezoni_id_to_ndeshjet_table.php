<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('ndeshjet', 'sezoni_id')) {
            Schema::table('ndeshjet', function (Blueprint $table) {
                $table->foreignId('sezoni_id')
                    ->nullable()
                    ->constrained('sezonet')
                    ->restrictOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('ndeshjet', 'sezoni_id')) {
            Schema::table('ndeshjet', function (Blueprint $table) {
                $table->dropConstrainedForeignId('sezoni_id');
            });
        }
    }
};
