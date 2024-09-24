<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationIssue extends Model
{
    use HasFactory;
    protected $table = 'publication_issue';

    public function issues(): HasMany
    {
        return $this->hasMany(Issue::class, 'publication_issue_id');
    }
}
