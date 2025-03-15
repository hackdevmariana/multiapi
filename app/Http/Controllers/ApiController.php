<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getInfo($info)
    {
        $data = [
            'appname' => ['app_name' => config('app.name')],
            'ip' => ['ip' => request()->ip()],
            'useragent' => ['user_agent' => request()->header('User-Agent')],
            'userlanguage' => ['preferred_language' => request()->getPreferredLanguage()],
            'url' => ['url' => request()->fullUrl()],
            'method' => ['method' => request()->method()],
            'referer' => ['referer' => request()->header('Referer') ?? 'N/A'],
        ];

        return response()->json($data[$info] ?? ['error' => 'Invalid endpoint']);
    }
}
