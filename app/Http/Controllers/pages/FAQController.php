<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

class FAQController extends Controller
{
    public function index()
    {
        return view('pages.faq');
    }
}
