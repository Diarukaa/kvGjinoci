<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kontratat', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->string('numri_kontrates')->unique();

            $table->string('roli');

            $table->decimal('paga_mujore', 10, 2);

            $table->date('data_fillimit');

            $table->date('data_mbarimit');

            $table->string('statusi')
                ->default('Aktive');

            $table->text('shenime')->nullable();

            $table->timestamps();

            $table->index([
                'user_id',
                'data_fillimit',
                'data_mbarimit'
            ]);
        });

        Schema::create('pagesat', function (Blueprint $table) {

            $table->id();

            $table->foreignId('kontrata_id')
                ->constrained('kontratat')
                ->restrictOnDelete();

            $table->date('muaji');

            $table->decimal('shuma', 10, 2);

            $table->string('statusi')
                ->default('Pa paguar');

            $table->date('data_pageses')->nullable();

            $table->string('metoda_pageses')->nullable();

            $table->text('shenime')->nullable();

            $table->timestamps();

            $table->unique([
                'kontrata_id',
                'muaji'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pagesat');

        Schema::dropIfExists('kontratat');
    }
};
