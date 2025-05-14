<?php

namespace App\Http\Controllers;

use App\Models\SiteNews;
use Illuminate\View\View;

class Main extends Controller
{
    public function show(): View
    {
        $newsList = SiteNews::getNewsList();
        return view('mainPage', ['newsList' => $newsList]);
    }
}
