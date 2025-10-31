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
        Schema::create('delivery_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spare_part_id')
                ->nullable()
                ->constrained('spare_parts')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('state_id')
                ->nullable()
                ->constrained('states')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('local_id')
                ->nullable()
                ->constrained('locals')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('machine_id')
                ->nullable()
                ->constrained('machines')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_notes');
    }
};
