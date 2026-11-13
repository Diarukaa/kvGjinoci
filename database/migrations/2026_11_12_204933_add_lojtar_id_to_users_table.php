<?php

use App\Models\Lojtar;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $lojtarTable = (new Lojtar())->getTable();

        Schema::table('users', function (Blueprint $table) use ($lojtarTable) {

            $table->foreignId('lojtar_id')
                ->nullable()
                ->unique()
                ->constrained($lojtarTable)
                ->nullOnDelete();

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropForeign(['lojtar_id']);
            $table->dropUnique(['lojtar_id']);
            $table->dropColumn('lojtar_id');

        });
    }
};
