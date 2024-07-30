<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;

class JournalIssueController extends Controller
{
    public function index()
    {
        return response()->json(['cards' => Issue::all()]);
    }

    public function updateViewCount(Request $request, $id)
    {
        $journalIssue = Issue::findOrFail($id);
        $journalIssue->update(['view' => $request->view]);
        var_dump($journalIssue);
        return response()->json(['message' => 'View count updated']);
    }
}
