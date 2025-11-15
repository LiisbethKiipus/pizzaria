<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class WelcomeController extends Controller
{
    public function welcome(): View
    {
        return view('welcome');
    }
}
