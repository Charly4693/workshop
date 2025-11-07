<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\Stmt\TraitUseAdaptation\Alias;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {// tenemos que hacer de que esta tabla lee la base de datos de prometo para que se sincronicen las maquinas
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias');

            // Relación opcional con la tabla locals
            $table->foreignId('local_id')
                ->nullable()
                ->constrained('locals')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            // Relación opcional con la tabla bars
            $table->foreignId('bar_id')
                ->nullable()
                ->constrained('bars')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->string('identificador');

            // Definir un campo tipo que indica si es parent (1) o roulette (2)
            $table->enum('type', ['parent', 'roulette','single'])->nullable();

            // Campo para asociar hijos a una máquina (ya sea tipo parent o roulette)
            $table->foreignId('parent_id')->nullable()->constrained('machines')->cascadeOnDelete();

            // placa de ComData, numero repetitivo que se diferencia por el machine_id, cada placa va asociada a una maquina
            //$table->intenger('Number_comData');

            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
