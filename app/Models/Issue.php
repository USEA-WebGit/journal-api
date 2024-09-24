<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Import this

class Issue extends Model
{
    use HasFactory;

    protected $fillable = [
        'issue_doi', 'major_id', 'journal_type_id', 'journal_title',
        'publication_issue_id', 'date_published', 'number_page',
        'abstract', 'pdf', 'keywords', 'issue_reference', 'view', 'status'
    ];

    protected $table = "journal_issue";

    // Relationship with authors (many-to-many)
    public function authors()
    {
        return $this->belongsToMany(Author::class, 'issue_author', 'issue_id', 'author_id');
    }

    // Relationship with major (many-to-one)
    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class, 'major_id');
    }

    // Relationship with journal keywords (many-to-many)
    public function journalKeyword()
    {
        return $this->belongsToMany(JournalKeywords::class, 'issue_keywords', 'key_id', 'issue_id');
    }

    // Relationship with journal type (many-to-one)
    public function journalType(): BelongsTo
    {
        return $this->belongsTo(JournalType::class, 'journal_type_id');
    }

    // Relationship with publication issue (one-to-many)
    public function publicationIssue(): BelongsTo
    {
        return $this->belongsTo(PublicationIssue::class, 'publication_issue_id');
    }
}

