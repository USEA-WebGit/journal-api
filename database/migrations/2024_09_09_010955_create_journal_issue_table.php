<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalIssueTable extends Migration
{
    public function up()
    {
        Schema::create('journal_issue', function (Blueprint $table) {
            $table->id();
            $table->string('issue_doi')->nullable();
            $table->foreignId('major_id')->constrained('journal_major')->onDelete('cascade');
            $table->foreignId('journal_type_id')->constrained('journal_type')->onDelete('cascade');
            $table->string('journal_title')->nullable();
            $table->foreignId('publication_issue_id')->constrained('publication_issue')->onDelete('cascade');
            $table->date('date_published')->nullable();
            $table->string('number_page')->nullable();
            $table->text('abstract')->nullable();
            $table->string('pdf')->nullable();
            $table->text('issue_reference')->nullable();
            $table->integer('view')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('journal_issue');
    }
};
