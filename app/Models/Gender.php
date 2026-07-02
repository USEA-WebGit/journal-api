<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gender extends Model
{
    use HasFactory;
    
    protected $table = 'gender';
    protected $fillable = ['type_en', 'type_kh'];

    // FIXED: hasMany relationship
    public function authors(): HasMany
    {
        return $this->hasMany(JournalAuthor::class, 'gender_id');
    }
}