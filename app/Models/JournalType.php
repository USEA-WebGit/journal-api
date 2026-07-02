<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JournalType extends Model
{
    use HasFactory;
    protected $primaryKey = 'type_id';
    protected $table = 'journal_type';
    protected $fillable = ['type_name_en', 'type_name_kh', 'filename', 'status'];

    public function issues(): HasMany
    {
        // Specify the foreign key if it's not 'type_id'
        return $this->hasMany(Issue::class, 'journal_type_id');
    }
}
