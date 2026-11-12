<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('klubet', function (Blueprint $table) {
            $table->id();
            $table->string('emri')->unique();
            $table->string('qyteti')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
        });

        Schema::create('kampionatet', function (Blueprint $table) {
            $table->id();

            $table->string('emri');

            $table->foreignId('sezoni_id')
                ->constrained('sezonet')
                ->restrictOnDelete();

            $table->string('kategoria');

            $table->timestamps();

            $table->unique([
                'emri',
                'sezoni_id',
                'kategoria'
            ]);
        });

        Schema::create('kampionati_klubi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kampionati_id')
                ->constrained('kampionatet')
                ->cascadeOnDelete();

            $table->foreignId('klubi_id')
                ->constrained('klubet')
                ->cascadeOnDelete();

            $table->unique([
                'kampionati_id',
                'klubi_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kampionati_klubi');
        Schema::dropIfExists('kampionatet');
        Schema::dropIfExists('klubet');
    }
};
