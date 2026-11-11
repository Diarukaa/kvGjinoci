<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trajner', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('emri');
            $table->string('mbiemri');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->date('dataELindjes');
            $table->integer('nrTelefonit');
            $table->string('vendbanimi');
            $table->integer('IBAN')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trajner');
    }
};
