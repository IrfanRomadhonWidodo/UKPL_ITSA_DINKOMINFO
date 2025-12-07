<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display the ITSA profile page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = [
            'title' => 'Profil ITSA - Dinas Komunikasi dan Informatika Banyumas',
            'meta_description' => 'Mengenal lebih dekat ITSA (Integrated Technology Service Application) Dinas Komunikasi dan Informatika Kabupaten Banyumas',
            'tentang' => [
                'title' => 'Tentang ITSA',
                'content' => 'ITSA (Integrated Technology Service Application) merupakan platform digital terpadu yang dikembangkan oleh Dinas Komunikasi dan Informatika Kabupaten Banyumas untuk memberikan layanan teknologi informasi yang terintegrasi kepada masyarakat dan instansi pemerintahan.',
                'penjelasan' => 'ITSA hadir sebagai solusi untuk mempermudah akses layanan teknologi informasi, mulai dari pengembangan aplikasi, pemeliharaan infrastruktur IT, hingga layanan konsultasi teknologi.',
                'latar_belakang' => 'Platform ini dikembangkan atas dasar kebutuhan akan layanan IT yang lebih efisien dan terpadu di lingkungan Pemerintah Kabupaten Banyumas, serta komitmen untuk meningkatkan kualitas pelayanan publik melalui pemanfaatan teknologi informasi.'
            ],
            'visi' => [
                'title' => 'Visi',
                'content' => 'Menjadi platform layanan teknologi informasi terdepan yang mendukung transformasi digital Kabupaten Banyumas menuju smart government dan smart city yang berkelanjutan.'
            ],
            'misi' => [
                'title' => 'Misi',
                'items' => [
                    'Menyediakan layanan teknologi informasi yang terintegrasi, berkualitas, dan mudah diakses oleh seluruh stakeholder.',
                    'Mendukung digitalisasi proses bisnis instansi pemerintah untuk meningkatkan efisiensi dan transparansi.',
                    'Membangun infrastruktur teknologi informasi yang handal dan aman untuk mendukung pelayanan publik.',
                    'Meningkatkan kapasitas SDM di bidang teknologi informasi melalui pelatihan dan pendampingan.',
                    'Menjalin kemitraan strategis dengan berbagai pihak untuk mengoptimalkan pemanfaatan teknologi informasi.'
                ]
            ],
            'tujuan' => [
                'title' => 'Tujuan Layanan',
                'items' => [
                    'Meningkatkan kualitas dan kecepatan pelayanan publik melalui pemanfaatan teknologi informasi.',
                    'Mempermudah akses masyarakat terhadap informasi dan layanan pemerintah secara digital.',
                    'Mendukung implementasi e-government di lingkungan Pemerintah Kabupaten Banyumas.',
                    'Mengoptimalkan penggunaan sumber daya teknologi informasi secara efisien dan efektif.',
                    'Menciptakan ekosistem digital yang terintegrasi untuk mendukung pembangunan daerah.'
                ]
            ]
        ];

        return view('pages.profil-itsa', compact('data'));
    }
}