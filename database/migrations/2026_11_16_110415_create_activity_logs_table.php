<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('user_id')
                ->nullable();

            $table->string('user_name')
                ->nullable();

            $table->string('user_role')
                ->nullable();

            $table->string('moduli');

            $table->string('veprimi');

            $table->string('model_type');

            $table->string('model_id')
                ->nullable();

            $table->string('pershkrimi');

            $table->json('vlerat_vjetra')
                ->nullable();

            $table->json('vlerat_reja')
                ->nullable();

            $table->timestamps();

            $table->index(['moduli', 'veprimi']);

            $table->index(['user_id', 'created_at']);

            $table->index('created_at');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
