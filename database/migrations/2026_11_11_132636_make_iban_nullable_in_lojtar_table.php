<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lojtar', function (Blueprint $table) {
            $table->string('IBAN')->nullable()->change();
        });
    }

    public function down(): void
    {
        // Do not automatically make IBAN required again.
        // Existing rows may now contain NULL values.
    }
};
