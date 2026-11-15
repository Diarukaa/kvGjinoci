<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksionet', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->enum('lloji', [
                'Hyrje',
                'Shpenzim'
            ]);

            $table->string('kategoria');
            $table->string('pershkrimi');
            $table->decimal('shuma', 12, 2);
            $table->date('data');
            $table->string('metoda_pageses');
            $table->string('referenca')->nullable();
            $table->text('shenime')->nullable();

            $table->timestamps();

            $table->index(['data', 'lloji']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksionet');
    }
};
