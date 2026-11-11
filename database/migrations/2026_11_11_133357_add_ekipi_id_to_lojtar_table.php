<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lojtar', function (Blueprint $table) {
            $table->foreignId('ekipi_id')
                ->nullable()
                ->constrained('ekipet')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('lojtar', function (Blueprint $table) {
            $table->dropConstrainedForeignId('ekipi_id');
        });
    }
};
