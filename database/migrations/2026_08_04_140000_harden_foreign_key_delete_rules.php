<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('delivery_notes', function (Blueprint $table) {
            $table->dropForeign(['spare_part_id']);
            $table->dropForeign(['state_id']);
            $table->dropForeign(['local_id']);
            $table->dropForeign(['bar_id']);
            $table->dropForeign(['machine_id']);
            $table->dropForeign(['user_id']);

            $table->foreign('spare_part_id')->references('id')->on('spare_parts')->nullOnDelete()->cascadeOnUpdate();
            $table->foreign('state_id')->references('id')->on('states')->nullOnDelete()->cascadeOnUpdate();
            $table->foreign('local_id')->references('id')->on('locals')->nullOnDelete()->cascadeOnUpdate();
            $table->foreign('bar_id')->references('id')->on('bars')->nullOnDelete()->cascadeOnUpdate();
            $table->foreign('machine_id')->references('id')->on('machines')->nullOnDelete()->cascadeOnUpdate();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete()->cascadeOnUpdate();
        });

        Schema::table('machines', function (Blueprint $table) {
            $table->dropForeign(['local_id']);
            $table->dropForeign(['bar_id']);
            $table->dropForeign(['parent_id']);

            $table->foreign('local_id')->references('id')->on('locals')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('bar_id')->references('id')->on('bars')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('parent_id')->references('id')->on('machines')->nullOnDelete()->cascadeOnUpdate();
        });

        Schema::table('spare_parts', function (Blueprint $table) {
            $table->dropForeign(['factory_id']);
            $table->dropForeign(['state_id']);

            $table->foreign('factory_id')->references('id')->on('factories')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('state_id')->references('id')->on('states')->restrictOnDelete()->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::table('delivery_notes', function (Blueprint $table) {
            $table->dropForeign(['spare_part_id']);
            $table->dropForeign(['state_id']);
            $table->dropForeign(['local_id']);
            $table->dropForeign(['bar_id']);
            $table->dropForeign(['machine_id']);
            $table->dropForeign(['user_id']);

            $table->foreign('spare_part_id')->references('id')->on('spare_parts')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('state_id')->references('id')->on('states')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('local_id')->references('id')->on('locals')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('bar_id')->references('id')->on('bars')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('machine_id')->references('id')->on('machines')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::table('machines', function (Blueprint $table) {
            $table->dropForeign(['local_id']);
            $table->dropForeign(['bar_id']);
            $table->dropForeign(['parent_id']);

            $table->foreign('local_id')->references('id')->on('locals')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('bar_id')->references('id')->on('bars')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('parent_id')->references('id')->on('machines')->cascadeOnDelete();
        });

        Schema::table('spare_parts', function (Blueprint $table) {
            $table->dropForeign(['factory_id']);
            $table->dropForeign(['state_id']);

            $table->foreign('factory_id')->references('id')->on('factories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('state_id')->references('id')->on('states')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }
};
