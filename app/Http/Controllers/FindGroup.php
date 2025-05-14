<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class FindGroup extends Controller
{
    public function show(): View
    {
        return view('FindGroup');
    }
}
