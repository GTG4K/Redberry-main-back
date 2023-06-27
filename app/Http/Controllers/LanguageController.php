<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function getLanguage(Request $request): string
    {
        return App::getLocale();
    }
    public function setLanguage(Request $request): void
    {
        $request->validate(['language' => 'required']);
        Session::put('language', $request->language);
        App::setLocale($request->language);
    }
}
