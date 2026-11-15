<?php

use App\Models\Manager;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $managerTable = (new Manager())->getTable();

        Schema::table('users', function (Blueprint $table) use ($managerTable) {
            $table->foreignId('manager_id')
                ->nullable()
                ->unique()
                ->constrained($managerTable)
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['manager_id']);
            $table->dropUnique(['manager_id']);
            $table->dropColumn('manager_id');
        });
    }
};
