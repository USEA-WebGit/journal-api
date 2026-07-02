<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GetFileController extends Controller
{
    public function getFile($filename)
    {
        // Define the path to the file
        $filePath = "public/assets/journal/volume1/issue1/{$filename}";

        // Ensure the file exists
        if (Storage::exists($filePath)) {
            return response()->download(storage_path("app/{$filePath}"));
        }

        return response()->json(['error' => 'File not found.'], 404);
    }
}
