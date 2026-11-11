<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('setet', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ndeshja_id')
                ->constrained('ndeshjet')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('numri_setit');
            $table->unsignedSmallInteger('piket_tona');
            $table->unsignedSmallInteger('piket_kundershtarit');

            $table->unique([
                'ndeshja_id',
                'numri_setit'
            ]);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('setet');
    }
};
