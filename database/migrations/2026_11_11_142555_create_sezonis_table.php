<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sezonet', function (Blueprint $table) {
            $table->id();
            $table->string('emri')->unique();
            $table->date('data_fillimit');
            $table->date('data_mbarimit');
            $table->boolean('aktiv')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sezonet');
    }
};
