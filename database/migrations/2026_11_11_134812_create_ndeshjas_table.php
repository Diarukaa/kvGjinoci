<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ndeshjet', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ekipi_id')
                ->constrained('ekipet')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('kundershtari');
            $table->dateTime('data_ndeshjes');
            $table->string('palestra');
            $table->enum('lokacioni', ['Vendas', 'Mysafir']);

            $table->enum('statusi', [
                'Planifikuar',
                'Perfunduar'
            ])->default('Planifikuar');

            $table->unsignedTinyInteger('setet_tona')
                ->nullable();

            $table->unsignedTinyInteger('setet_kundershtarit')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ndeshjet');
    }
};
