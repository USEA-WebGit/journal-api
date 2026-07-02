<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalKeywords extends Model
{
    use HasFactory;
    protected $table = 'journal_keywords';
    protected  $fillable = ['name_en', 'name_kh'];
    public $timestamps = false;

    public function issues()
    {
        // Specify the foreign key if it's not 'type_id'
        return $this->hasMany(Issue::class, 'key_id');
    }
}