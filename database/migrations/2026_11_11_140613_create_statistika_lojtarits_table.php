<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('statistikat_lojtareve', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ndeshja_id')
                ->constrained('ndeshjet')
                ->cascadeOnDelete();

            $table->foreignId('lojtar_id')
                ->constrained('lojtar')
                ->restrictOnDelete();

            $table->unsignedSmallInteger('kills')->default(0);
            $table->unsignedSmallInteger('aces')->default(0);
            $table->unsignedSmallInteger('blocks')->default(0);
            $table->unsignedSmallInteger('digs')->default(0);

            $table->unique(['ndeshja_id', 'lojtar_id']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statistikat_lojtareve');
    }
};
