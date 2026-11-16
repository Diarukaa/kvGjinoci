<?php

use App\Models\Lojtar;
use App\Models\Ndeshja;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $ndeshjetTable = (new Ndeshja())->getTable();
        $lojtaretTable = (new Lojtar())->getTable();

        Schema::create(
            'formacion_pozicionet',
            function (Blueprint $table) use (
                $ndeshjetTable,
                $lojtaretTable
            ) {
                $table->id();

                $table->foreignId('ndeshja_id')
                    ->constrained($ndeshjetTable)
                    ->cascadeOnDelete();

                $table->foreignId('lojtar_id')
                    ->constrained($lojtaretTable)
                    ->cascadeOnDelete();

                $table->unsignedTinyInteger('seti');
                $table->unsignedTinyInteger('pozicioni');

                $table->timestamps();

                $table->unique(
                    [
                        'ndeshja_id',
                        'seti',
                        'pozicioni',
                    ],
                    'formacion_unique_position'
                );

                $table->unique(
                    [
                        'ndeshja_id',
                        'seti',
                        'lojtar_id',
                    ],
                    'formacion_unique_player'
                );
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('formacion_pozicionet');
    }
};
