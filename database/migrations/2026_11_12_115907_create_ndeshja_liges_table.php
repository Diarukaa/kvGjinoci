<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ndeshjet_liges', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kampionati_id')
                ->constrained('kampionatet')
                ->restrictOnDelete();

            $table->foreignId('klubi_vendas_id')
                ->constrained('klubet')
                ->restrictOnDelete();

            $table->foreignId('klubi_mysafir_id')
                ->constrained('klubet')
                ->restrictOnDelete();

            $table->date('data_ndeshjes');

            $table->unsignedTinyInteger('setet_vendas');
            $table->unsignedTinyInteger('setet_mysafir');

            $table->timestamps();

            $table->unique(
                [
                    'kampionati_id',
                    'klubi_vendas_id',
                    'klubi_mysafir_id',
                    'data_ndeshjes'
                ],
                'ndeshja_liges_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ndeshjet_liges');
    }
};
