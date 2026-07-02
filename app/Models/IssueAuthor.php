<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueAuthor extends Model
{
    use HasFactory;
    protected $table = 'issue_author';
    public $timestamps = false; // Disable timestamps if not present
}
