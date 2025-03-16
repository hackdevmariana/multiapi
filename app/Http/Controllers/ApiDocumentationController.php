<?php
namespace App\Http\Controllers;

use App\Models\ApiDocumentation;
use Illuminate\Http\Request;

class ApiDocumentationController extends Controller
{
    public function index($language = 'en')
    {
        $documentation = ApiDocumentation::where('language', $language)->get();
        return response()->json($documentation);
    }
}
