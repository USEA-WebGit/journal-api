<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalKeywords extends Model
{
    use HasFactory;
    protected $table = 'journal_keywords';

    public function issues(): HasMany
    {
        // Specify the foreign key if it's not 'type_id'
        return $this->hasMany(Issue::class, 'key_id');
    }
}
