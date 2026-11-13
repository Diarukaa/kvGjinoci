<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lojtar', function (Blueprint $table) {
            $table->string('nrTelefonit', 20)->change();
        });

        Schema::table('trajner', function (Blueprint $table) {
            $table->string('nrTelefonit', 20)->change();
        });

        Schema::table('managers', function (Blueprint $table) {
            $table->string('nrTelefonit', 20)->change();
        });
    }

    public function down(): void
    {
        throw new \RuntimeException(
            'Phone numbers cannot safely be converted back to integers.'
        );
    }
};
