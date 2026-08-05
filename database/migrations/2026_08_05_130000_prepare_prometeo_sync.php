<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('locals', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->index();
            $table->timestamp('synced_at')->nullable()->index();
        });

        Schema::table('bars', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->index();
            $table->timestamp('synced_at')->nullable()->index();
        });

        Schema::table('machines', function (Blueprint $table) {
            $table->enum('type', ['parent', 'roulette', 'single', 'AADD'])
                ->nullable()
                ->change();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamp('synced_at')->nullable()->index();
        });

        Schema::create('prometeo_sync_runs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status');
            $table->json('counts')->nullable();
            $table->string('error')->nullable();
            $table->timestamp('started_at');
            $table->timestamp('finished_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prometeo_sync_runs');

        DB::table('machines')->where('type', 'AADD')->update(['type' => null]);

        Schema::table('machines', function (Blueprint $table) {
            $table->enum('type', ['parent', 'roulette', 'single'])
                ->nullable()
                ->change();
            $table->dropColumn(['is_active', 'synced_at']);
        });

        Schema::table('bars', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'synced_at']);
        });

        Schema::table('locals', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'synced_at']);
        });
    }
};
