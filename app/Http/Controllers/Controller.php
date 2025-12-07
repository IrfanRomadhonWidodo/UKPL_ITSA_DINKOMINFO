<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;   // ← WAJIB

class Controller extends BaseController               // ← WAJIB
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
