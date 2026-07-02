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
        Schema::table('journal_authors', function (Blueprint $table) {
            // Check if gender column exists and drop it
            if (Schema::hasColumn('journal_authors', 'gender')) {
                $table->dropColumn('gender');
            }

            // Ensure the gender_id column is added after lastname
            if (!Schema::hasColumn('journal_authors', 'gender_id')) {
                $table->foreignId('gender_id')
                    ->nullable()
                    ->after('lastname') // Ensure this line is correct
                    ->constrained('gender')
                    ->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('journal_authors', function (Blueprint $table) {
            if (Schema::hasColumn('journal_authors', 'gender_id')) {
                $table->dropForeign(['gender_id']);
                $table->dropColumn('gender_id');
            }

            // Optionally, add back the old gender column
            if (!Schema::hasColumn('journal_authors', 'gender')) {
                $table->string('gender')->nullable()->after('lastname');
            }
        });
    }
};
