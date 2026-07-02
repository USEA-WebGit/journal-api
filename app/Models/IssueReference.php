<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IssueReference extends Model
{
    use HasFactory;
    
    protected $table = 'issue_reference';
    
    public $timestamps = false;
    
    protected $fillable = ['key_id', 'issue_id'];
    
    protected $casts = [
        'key_id' => 'integer',
        'issue_id' => 'integer',
    ];

    public function journalReference(): BelongsTo
    {
        return $this->belongsTo(JournalReference::class, 'key_id');
    }
    public function issue(): BelongsTo
    {
        return $this->belongsTo(Issue::class, 'issue_id');
    }

    public function reference(): BelongsTo
    {
        return $this->belongsTo(JournalReference::class, 'key_id');
    }
}