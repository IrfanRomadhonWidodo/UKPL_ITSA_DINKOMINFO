<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

class LayananController extends Controller
{
    public function index()
    {
        return view('pages.alur-layanan');
    }
}
