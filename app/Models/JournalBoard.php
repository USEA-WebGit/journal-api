<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalBoard extends Model
{
    use HasFactory;
    protected $table = "journal_board";
    protected $guard = ["id"];
}
