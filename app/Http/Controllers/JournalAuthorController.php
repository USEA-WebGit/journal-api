<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
class JournalAuthorController extends Controller
{
    //

    public function index(){
        $authors = Author::all();
        return response()->json(['authors' => Author::all()]);
    }
}
