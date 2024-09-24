<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueKeywords extends Model
{
    use HasFactory;
    protected $table = 'issue_keywords';
    public $timestamps = false; // Disable timestamps if not present
}
