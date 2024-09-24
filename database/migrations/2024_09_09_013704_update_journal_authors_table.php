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
            // Remove the old gender column if it exists
            $table->dropColumn('gender');

            // Add the new gender_id column and set up the foreign key
            $table->foreignId('gender_id')->nullable()->after('lastname')->constrained('gender')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('journal_authors', function (Blueprint $table) {
            // Drop the foreign key and gender_id column
            $table->dropForeign(['gender_id']);
            $table->dropColumn('gender_id');

            // Optionally, add back the old gender column if necessary
            $table->string('gender')->nullable();
        });
    }
};
