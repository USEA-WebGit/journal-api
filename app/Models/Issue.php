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
        'abstract', 'pdf', 'keywords', 'issue_reference', 'cite', 'view', 'status'
    ];

    protected $table = "journal_issue";

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'issue_author', 'issue_id', 'author_id');
    }

    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class, 'major_id');
    }

    public function journalKeyword()
    {
        return $this->belongsToMany(JournalKeywords::class, 'issue_keywords', 'issue_id', 'key_id');
    }

    public function journalReferences()
    {
        return $this->belongsToMany(
            JournalReference::class,
            'issue_reference',
            'issue_id',
            'ref_id'
        );
    }


    public function journalType(): BelongsTo
    {
        return $this->belongsTo(JournalType::class, 'journal_type_id');
    }

    public function publicationIssue(): BelongsTo
    {
        return $this->belongsTo(PublicationIssue::class, 'publication_issue_id');
    }
    public function issueReferences()
    {
        return $this->hasMany(IssueReference::class, 'issue_id');
    }

}