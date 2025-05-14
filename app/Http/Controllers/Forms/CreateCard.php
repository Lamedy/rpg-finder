<?php

namespace App\Http\Controllers\Forms;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CreateCard extends Controller
{
    public function show(): View
    {
        return view('Forms.createCard');
    }
}
