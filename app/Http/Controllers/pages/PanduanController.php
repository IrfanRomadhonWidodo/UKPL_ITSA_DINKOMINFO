<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

class PanduanController extends Controller
{
    public function index()
    {
        return view('pages.panduan');
    }
}
