<?php

use App\Models\Ndeshja;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('match_center_matches', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ndeshja_id')
                ->unique()
                ->constrained((new Ndeshja())->getTable())
                ->cascadeOnDelete();

            $table->string('mode')->default('manual');
            $table->string('status')->default('draft');

            $table->timestamps();
        });

        Schema::create('match_center_sets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('match_center_match_id')
                ->constrained('match_center_matches')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('set_number');
            $table->unsignedSmallInteger('home_points')->default(0);
            $table->unsignedSmallInteger('away_points')->default(0);

            $table->boolean('is_completed')->default(false);
            $table->timestamps();

            $table->unique([
                'match_center_match_id',
                'set_number',
            ]);
        });

        Schema::create('match_center_events', function (Blueprint $table) {
            $table->id();

            $table->foreignId('match_center_set_id')
                ->constrained('match_center_sets')
                ->cascadeOnDelete();

            $table->string('team');
            $table->foreignId('user_id')->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('match_center_events');
        Schema::dropIfExists('match_center_sets');
        Schema::dropIfExists('match_center_matches');
    }
};
