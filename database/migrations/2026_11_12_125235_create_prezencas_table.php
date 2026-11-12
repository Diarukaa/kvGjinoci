<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prezencat', function (Blueprint $table) {
            $table->id();

            $table->foreignId('stervitja_id')
                ->constrained('stervitjet')
                ->cascadeOnDelete();

            $table->foreignId('lojtar_id')
                ->constrained('lojtar')
                ->restrictOnDelete();

            $table->enum('statusi', [
                'Prezente',
                'Mungon',
                'Me vonese',
                'E arsyetuar'
            ]);

            $table->text('shenime')->nullable();

            $table->timestamps();

            $table->unique([
                'stervitja_id',
                'lojtar_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prezencat');
    }
};
