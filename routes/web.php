<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JournalIssueController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/test', [JournalIssueController::class, 'updateViewCount']);
// Route::get('/documents/{filename}', function ($filename) {
//     $path = 'assets/journal/' . $filename;

//     if (Storage::disk('public')->exists($path)) {
//         return response()->file(storage_path('app/public/' . $path));
//     }

//     abort(404);
// });
