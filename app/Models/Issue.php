<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;
    protected $fillable = ['major', 'journal_type', 'journal_title', 'author', 'volume_number', 'issue_number', 'date_published', 'number_page', 'abstract', 'pdf', 'view', 'status'];
    protected $table = "journal_issue";
    // protected $guard = ["id"];
}
