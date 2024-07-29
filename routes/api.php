<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetFileController;
use App\Http\Controllers\JournalIssueController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/journal-issues', [JournalIssueController::class, 'index']);
Route::patch('journal-issues/{id}', [JournalIssueController::class, 'updateViewCount']);
Route::get('/document/{filename}', [GetFileController::class, 'getFile']);
