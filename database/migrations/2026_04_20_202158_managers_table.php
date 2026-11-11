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
        Schema::create('managers', function (Blueprint $table) {
            $table->id();
            $table->string('emri');
            $table->string('mbiemri');
            $table->string('email');
            $table->timestamp('email_verified_at');
            $table->date('dataELindjes');
            $table->integer('nrTelefonit');
            $table->string('vendbanimi');
            $table->integer('IBAN')->unique();
            $table->string('roli');
            $table->timestamps();
        });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('managers');
    }
};
