<?php
namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;

class JournalIssueController extends Controller
{
    public function index()
{
    // Retrieve all issues with related data (authors, journalType, etc.)
    $issues = Issue::with('journalType', 'major', 'publicationIssue', 'authors')->get();
    // Map over the collection to format the data as needed
    return response()->json($issues->map(function($issue) {
        return [
            'id' => $issue->id,
            'issue_doi' => $issue->issue_doi,
            'authors' => $issue->authors->map(function($author) {
                return [
                    'id' => $author->id,
                    'name' => $author->firstname . ' ' . $author->lastname,
                    'email' => $author->email,
                    'orcid' => $author->author_orcid
                ];
            }),
            'major_id' => $issue->major->major_name_en,
            'journal_type' => $issue->journalType->type_name_en,
            'journal_title' => $issue->journal_title,
            'publication_issue_id' => $issue->publication_issue_id,
            'volume_published' => $issue->publicationIssue->volume_number,
            'issue_published' => $issue->publicationIssue->issue_number,
            'year_published' => $issue->publicationIssue->year,
            'date_published' => $issue->date_published,
            'number_page' => $issue->number_page,
            'abstract' => $issue->abstract,
            'pdf' => $issue->pdf,
            'issue_reference' => $issue->issue_reference,
            'view' => $issue->view,
            'keywords' => $issue->journalKeyword->map(function($keywords) {
                return [
                    'id' => $keywords->id,
                    'name' => $keywords->name_en,
                ];
            }),
            'status' => $issue->status,
            'created_at' => $issue->created_at,
            'updated_at' => $issue->updated_at,
        ];
    }));
}

    public function show($id)
{
    $issue = Issue::with('journalType', 'major', 'publicationIssue', 'authors')->findOrFail($id);

    return response()->json([
        'id' => $issue->id,
        'issue_doi' => $issue->issue_doi,
        'authors' => $issue->authors->map(function($author) {
            return [
                'id' => $author->id,
                'name' => $author->firstname . ' ' . $author->lastname,
                'email' => $author->email,
                'orcid' => $author->author_orcid
            ];
        }),
        'major_id' => $issue->major->major_name_en,
        'journal_type' => $issue->journalType->type_name_en,
        'journal_title' => $issue->journal_title,
        'publication_issue_id' => $issue->publication_issue_id,
        'volume_published' => $issue->publicationIssue->volume_number,
        'issue_published' => $issue->publicationIssue->issue_number,
        'year_published' => $issue->publicationIssue->year,
        'number_page' => $issue->number_page,
        'abstract' => $issue->abstract,
        'pdf' => $issue->pdf,
        'issue_reference' => $issue->issue_reference,
        'view' => $issue->view,
        'status' => $issue->status,
        'created_at' => $issue->created_at,
        'updated_at' => $issue->updated_at,
    ]);
}


    public function updateViewCount(Request $request, $id)
    {
        $validated = $request->validate([
            'view' => 'required|integer',
        ]);

        $journalIssue = Issue::findOrFail($id);
        $journalIssue->update(['view' => $validated['view']]);
        return response()->json(['message' => 'View count updated']);
    }
}

