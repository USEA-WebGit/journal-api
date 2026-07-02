<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetFileController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\JournalIssueController;
use App\Http\Controllers\JournalBoardController;
use App\Http\Controllers\JournalAuthorController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/journal-issues', [JournalIssueController::class, 'index']);
Route::patch('/journal-issues/{id}', [JournalIssueController::class, 'updateViewCount']);
Route::get('/document/{filename}', [GetFileController::class, 'getFile']);
Route::get('/journal-template', [TemplateController::class, 'index']);
Route::get('/journal-boards', [JournalBoardController::class, 'index']);
Route::get('/journal-authors', [JournalAuthorController::class, 'index']);
