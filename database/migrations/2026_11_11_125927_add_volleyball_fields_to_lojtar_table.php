<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('lojtar', 'numriFanelles')) {
            Schema::table('lojtar', function (Blueprint $table) {
                $table->unsignedTinyInteger('numriFanelles')->nullable();
            });
        }

        if (!Schema::hasColumn('lojtar', 'pozicioni')) {
            Schema::table('lojtar', function (Blueprint $table) {
                $table->string('pozicioni')->nullable();
            });
        }
    }

    public function down(): void
    {
        // Existing columns may predate this migration.
        // Do not drop them during rollback.
    }
};
