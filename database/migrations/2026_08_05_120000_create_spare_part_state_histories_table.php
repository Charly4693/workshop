<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spare_part_state_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spare_part_id')
                ->constrained('spare_parts')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('previous_state_id')
                ->nullable()
                ->constrained('states')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('new_state_id')
                ->constrained('states')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('changed_by_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();

            $table->index(['spare_part_id', 'created_at']);
        });

        $now = now();

        DB::table('spare_parts')
            ->select(['id', 'state_id'])
            ->orderBy('id')
            ->chunkById(500, function ($spareParts) use ($now): void {
                DB::table('spare_part_state_histories')->insert(
                    $spareParts->map(fn ($sparePart): array => [
                        'spare_part_id' => $sparePart->id,
                        'previous_state_id' => null,
                        'new_state_id' => $sparePart->state_id,
                        'changed_by_user_id' => null,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ])->all(),
                );
            });
    }

    public function down(): void
    {
        Schema::dropIfExists('spare_part_state_histories');
    }
};
