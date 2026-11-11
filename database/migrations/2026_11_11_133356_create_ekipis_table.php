<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ekipet', function (Blueprint $table) {
            $table->id();

            $table->string('emri')->unique();
            $table->string('kategoria');

            $table->foreignId('trajner_id')
                ->nullable()
                ->constrained('trajner')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ekipet');
    }
};
