<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasColumn('tasks', 'trip_id')) {
            Schema::table('tasks', function (Blueprint $table) {
                $table->foreignId('trip_id')
                    ->after('user_id')
                    ->nullable()
                    ->constrained()
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('tasks', 'trip_id')) {
            Schema::table('tasks', function (Blueprint $table) {
                $table->dropConstrainedForeignId('trip_id');
            });
        }
    }
};
