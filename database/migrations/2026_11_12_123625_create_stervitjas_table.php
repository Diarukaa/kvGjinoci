<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stervitjet', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ekipi_id')
                ->constrained('ekipet')
                ->restrictOnDelete();

            $table->foreignId('trajner_id')
                ->nullable()
                ->constrained('trajner')
                ->nullOnDelete();

            $table->foreignId('sezoni_id')
                ->nullable()
                ->constrained('sezonet')
                ->restrictOnDelete();

            $table->date('data');
            $table->time('ora_fillimit');
            $table->time('ora_mbarimit');

            $table->string('palestra');

            $table->enum('lloji', [
                'Fizike',
                'Teknike',
                'Taktike',
                'Miqesore',
                'Rikuperim'
            ]);

            $table->enum('statusi', [
                'Planifikuar',
                'Perfunduar',
                'Anuluar'
            ])->default('Planifikuar');

            $table->text('pershkrimi')->nullable();

            $table->timestamps();

            $table->index(['ekipi_id', 'data']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stervitjet');
    }
};
