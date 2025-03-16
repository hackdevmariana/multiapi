<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UtilityController extends Controller
{
    public function check()
    {
        return response()->json(['status' => 'OK']);
    }

    public function generatePassword(Request $request)
    {
        $length = $request->query('length', 12);
        return response()->json(['password' => Str::random($length)]);
    }

    public function limitText(Request $request)
    {
        $text = $request->query('text', 'Hola, mundo');
        $length = $request->query('length', 20);
        return response()->json(['text limited' => Str::limit($text, $length)]);
    }

    public function slugify($text)
    {
        return response()->json(['slug' => Str::slug($text)]);
    }

    public function camelCase($text)
    {
        return response()->json(['camel' => Str::camel($text)]);
    }

    public function kebabCase($text)
    {
        return response()->json(['kebab' => Str::kebab($text)]);
    }

    public function titleCase($text)
    {
        return response()->json(['title' => Str::title($text)]);
    }

    public function snakeCase($text)
    {
        return response()->json(['snake' => Str::snake($text)]);
    }

    public function generateQrCode(Request $request)
    {
        $text = $request->query('text', 'Default text');
        $size = max(100, min((int) $request->query('size', 200), 1000)); 
        $qrCode = QrCode::format('png')->size($size)->generate($text);
        return response($qrCode, 200)->header('Content-Type', 'image/png');
    }

    public function validateEmail($email)
    {
        $isValid = filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
        return response()->json(['email' => $email, 'valid' => $isValid]);
    }

    public function generateUuid()
    {
        return response()->json(['uuid' => Str::uuid()]);
    }

    public function getCurrentDateTime()
    {
        return response()->json(['datetime' => now()->toDateTimeString()]);
    }
}
