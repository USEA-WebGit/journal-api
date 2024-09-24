<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $table = 'journal_authors';
    protected $fillable = ["firstname", "lastname", "gender", "email", "author_orcid"];

    public function issues()
    {
        return $this->belongsToMany(Issue::class, 'issue_author', 'author_id', 'issue_id');
    }
}
