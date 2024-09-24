<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueAuthorTable extends Migration
{
    public function up()
    {
        Schema::create('issue_author', function (Blueprint $table) {
            $table->id();
            $table->foreignId('issue_id')->constrained('journal_issue')->onDelete('cascade');
            $table->foreignId('author_id')->constrained('journal_authors')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('issue_author');
    }
}

