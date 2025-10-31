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
    {// tenemos que hacer de que esta tabla lee la base de datos de prometo para que se sincronicen los locales
        Schema::create('locals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('factory_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('name');
            $table->json('dbconection');
            // clave foranea para que en cada local tenga un idMachine asociada
            $table->string('idMachines')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locals');
    }
};
