<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Feedback;
use App\Models\Formulir;
use App\Models\Notifikasi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // Hitung data pengguna
        $totalUsers = User::count();
        $usersDiproses = User::where('status', 'diproses')->count();
        $usersDisetujui = User::where('status', 'disetujui')->count();
        $usersDitolak = User::where('status', 'ditolak')->count();

        // Hitung data feedback
        $totalFeedbacks = Feedback::count();
        $feedbackDiproses = Feedback::where('status', 'diproses')->count();
        $feedbackSelesai = Feedback::where('status', 'selesai')->count();

        // Hitung data formulir
        $totalFormulirs = Formulir::count();
        $formulirDiproses = Formulir::where('status', 'diproses')->count();
        $formulirRevisi = Formulir::where('status', 'revisi')->count();
        $formulirSelesai = Formulir::where('status', 'selesai')->count();

        // Hitung data notifikasi
        $totalNotifikasi = Notifikasi::count();
        $notifikasiBelumDibaca = Notifikasi::where('is_read', false)->count();
        $notifikasiSudahDibaca = Notifikasi::where('is_read', true)->count();

        // Data untuk chart aktivitas mingguan (7 hari terakhir)
        $weeklyActivity = $this->getWeeklyActivity();

        // Data untuk chart distribusi status
        $statusDistribution = $this->getStatusDistribution();

        // Data untuk chart performa metrik
        $performanceMetrics = $this->getPerformanceMetrics();

        // Data untuk chart trend bulanan
        $monthlyTrend = $this->getMonthlyTrend();

        return view('admin.dashboard', compact(
            'totalUsers', 'usersDiproses', 'usersDisetujui', 'usersDitolak',
            'totalFeedbacks', 'feedbackDiproses', 'feedbackSelesai',
            'totalFormulirs', 'formulirDiproses', 'formulirRevisi', 'formulirSelesai',
            'totalNotifikasi', 'notifikasiBelumDibaca', 'notifikasiSudahDibaca',
            'weeklyActivity', 'statusDistribution', 'performanceMetrics', 'monthlyTrend'
        ));
    }

    private function getWeeklyActivity()
    {
        $weeklyData = [];
        $days = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dayName = $days[$date->dayOfWeek == 0 ? 6 : $date->dayOfWeek - 1];
            
            $users = User::whereDate('created_at', $date)->count();
            $feedbacks = Feedback::whereDate('created_at', $date)->count();
            $formulirs = Formulir::whereDate('created_at', $date)->count();
            
            $weeklyData[] = [
                'day' => $dayName,
                'date' => $date->format('Y-m-d'),
                'users' => $users,
                'feedbacks' => $feedbacks,
                'formulirs' => $formulirs,
                'total' => $users + $feedbacks + $formulirs
            ];
        }
        
        return $weeklyData;
    }

    private function getStatusDistribution()
    {
        return [
            'users' => [
                'diproses' => User::where('status', 'diproses')->count(),
                'disetujui' => User::where('status', 'disetujui')->count(),
                'ditolak' => User::where('status', 'ditolak')->count(),
            ],
            'feedbacks' => [
                'diproses' => Feedback::where('status', 'diproses')->count(),
                'selesai' => Feedback::where('status', 'selesai')->count(),
            ],
            'formulirs' => [
                'diproses' => Formulir::where('status', 'diproses')->count(),
                'revisi' => Formulir::where('status', 'revisi')->count(),
                'selesai' => Formulir::where('status', 'selesai')->count(),
            ]
        ];
    }

    private function getPerformanceMetrics()
    {
        $totalUsers = User::count();
        $totalFeedbacks = Feedback::count();
        $totalFormulirs = Formulir::count();

        // Hitung metrik performa berdasarkan data real
        $responseTime = $totalFeedbacks > 0 ? 
            (Feedback::where('status', 'selesai')->count() / $totalFeedbacks) * 100 : 0;

        $userApprovalRate = $totalUsers > 0 ? 
            (User::where('status', 'disetujui')->count() / $totalUsers) * 100 : 0;

        $taskCompletionRate = $totalFormulirs > 0 ? 
            (Formulir::where('status', 'selesai')->count() / $totalFormulirs) * 100 : 0;

        return [
            'response_time' => round($responseTime, 1),
            'user_approval_rate' => round($userApprovalRate, 1),
            'task_completion_rate' => round($taskCompletionRate, 1),
        ];
    }

    private function getMonthlyTrend()
    {
        $monthlyData = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->format('M Y');
            
            $users = User::whereMonth('created_at', $date->month)
                        ->whereYear('created_at', $date->year)
                        ->count();
            
            $feedbacks = Feedback::whereMonth('created_at', $date->month)
                               ->whereYear('created_at', $date->year)
                               ->count();
            
            $formulirs = Formulir::whereMonth('created_at', $date->month)
                               ->whereYear('created_at', $date->year)
                               ->count();
            
            $monthlyData[] = [
                'month' => $monthName,
                'users' => $users,
                'feedbacks' => $feedbacks,
                'formulirs' => $formulirs,
            ];
        }
        
        return $monthlyData;
    }
}