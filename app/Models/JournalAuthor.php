<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JournalAuthor extends Model
{
    use HasFactory;
    
    protected $table = 'journal_authors';
    protected $fillable = ['firstname', 'lastname', 'gender_id', 'email', 'author_orcid'];
    public $timestamps = false;

    // FIXED: Proper belongsTo relationship
    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class, 'gender_id', 'id');
        // Explicitly specify: belongsTo(RelatedModel, foreignKey, ownerKey)
    }
}