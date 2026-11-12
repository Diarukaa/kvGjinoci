<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ndeshjet_liges', function (Blueprint $table) {
            $table->foreignId('ndeshja_id')
                ->nullable()
                ->unique()
                ->constrained('ndeshjet')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('ndeshjet_liges', function (Blueprint $table) {
            $table->dropForeign(['ndeshja_id']);
            $table->dropUnique(['ndeshja_id']);
            $table->dropColumn('ndeshja_id');
        });
    }
};
