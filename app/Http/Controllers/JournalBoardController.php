<?php

namespace App\Http\Controllers;
use App\Models\JournalBoard;
use Illuminate\Http\Request;

class JournalBoardController extends Controller
{
    public function index(){
        $board = JournalBoard::all();
        return response(['boards' => $board]);
    }
}
