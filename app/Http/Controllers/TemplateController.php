<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    function index(){
        return response()->json(['templates' => Template::all()]);
    }
}
