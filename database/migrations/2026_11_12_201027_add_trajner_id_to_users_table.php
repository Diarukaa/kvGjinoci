<?php

use App\Models\Trajner;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $trajnerTable = (new Trajner())->getTable();

        Schema::table('users', function (Blueprint $table) use ($trajnerTable) {

            $table->foreignId('trajner_id')
                ->nullable()
                ->unique()
                ->constrained($trajnerTable)
                ->nullOnDelete();

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['trajner_id']);
            $table->dropUnique(['trajner_id']);
            $table->dropColumn('trajner_id');
        });
    }
};
