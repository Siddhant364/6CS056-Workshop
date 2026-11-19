<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('courses')) {
            return;
        }

        Schema::table('courses', function (Blueprint $table) {
            if (! Schema::hasColumn('courses', 'duration')) {
                $table->unsignedInteger('duration')->nullable();
            }

            if (! Schema::hasColumn('courses', 'fee')) {
                $table->decimal('fee', 10, 2)->nullable();
            }

            if (! Schema::hasColumn('courses', 'difficulty')) {
                $table->string('difficulty')->nullable();
            }

            if (! Schema::hasColumn('courses', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }

            // Preserve legacy values while allowing the current form to create
            // courses without fields that are no longer used.
            if (Schema::hasColumn('courses', 'code')) {
                $table->string('code')->nullable()->change();
            }

            if (Schema::hasColumn('courses', 'credits')) {
                $table->integer('credits')->nullable()->change();
            }
        });
    }

    public function down(): void
    {
        // Keep legacy data and reconciled columns intact on rollback.
    }
};
