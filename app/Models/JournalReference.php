<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalReference extends Model
{
    use HasFactory;
    protected $table = 'journal_reference';
    protected $fillable = ['reference', 'doi', 'google_scholar', 'website'];
    public $timestamps = false;

    public function issues()
    {
        return $this->belongsToMany(
        Issue::class,
        'issue_reference',
        'ref_id',   // reference id in pivot
        'issue_id'
    );
    }
}