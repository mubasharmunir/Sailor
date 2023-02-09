<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class PageController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function blog()
    {
        return view('blog');
    }

    public function portfolio()
    {
        return view('portfolio');
    }
}
