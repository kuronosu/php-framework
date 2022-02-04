<?php

namespace App\Http\Controllers;

class HomeController
{
    public function GET()
    {
        return view('home');
    }

    public function POST()
    {
        return view('home_post');
    }
}
