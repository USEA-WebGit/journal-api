<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationIssue extends Model
{
    use HasFactory;
    protected $table = 'publication_issue';
    protected $fillable = ['volume_number', 'issue_number', 'number_page', 'year'];
    public $timestamps = false;

    public function issues()
    {
        return $this->hasMany(Issue::class, 'publication_issue_id');
    }
    public function getTitleAttribute(): string
{
    return "{$this->year} - Vol. {$this->volume}, Issue {$this->issue}";
}
}