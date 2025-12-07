<?php

namespace App\Http\Controllers;

use App\Models\Formulir;
use App\Models\Feedback;
use App\Models\Hasil;

class DashboardController extends Controller
{
    public function index()
    {
        $totalFormulir = Formulir::count(); // semua formulir
        $formulirSelesai = Formulir::where('status', 'selesai')->count(); // status selesai
        $totalFeedback = Feedback::count(); // semua feedback

        $hasilList = Hasil::with('formulir')->latest()->paginate(6); // ambil semua hasil ITSA

        return view('dashboard', compact(
            'totalFormulir',
            'formulirSelesai',
            'totalFeedback',
            'hasilList' 
        ));
    }
}
