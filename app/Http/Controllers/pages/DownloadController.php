<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function index()
    {
        $document = [
            'title' => 'Dokumen Syarat dan Ketentuan ITSA',
            'description' => 'Dokumen ini berisi syarat dan ketentuan yang berlaku untuk ITSA (Information Technology Student Association). Silakan baca dengan seksama sebelum mengunduh.',
            'filename' => 'Dokumen Syarat dan Ketentuan _ITSA.pdf',
            'filepath' => 'pdf/Dokumen Syarat dan Ketentuan _ITSA.pdf',
            'size' => $this->getFileSize('pdf/Dokumen Syarat dan Ketentuan _ITSA.pdf'),
            'updated_at' => $this->getLastModified('pdf/Dokumen Syarat dan Ketentuan _ITSA.pdf')
        ];

        return view('pages.download', compact('document'));
    }

    public function download()
    {
        $filename = 'Dokumen Syarat dan Ketentuan _ITSA.pdf';
        $filepath = public_path('pdf/' . $filename);

        if (!file_exists($filepath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($filepath, $filename, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    private function getFileSize($filepath)
    {
        try {
            $fullPath = public_path($filepath);
            if (file_exists($fullPath)) {
                $bytes = filesize($fullPath);
                return $this->formatBytes($bytes);
            }
            return 'N/A';
        } catch (\Exception $e) {
            return 'N/A';
        }
    }

    private function getLastModified($filepath)
    {
        try {
            $fullPath = public_path($filepath);
            if (file_exists($fullPath)) {
                $timestamp = filemtime($fullPath);
                return date('d F Y', $timestamp);
            }
            return 'N/A';
        } catch (\Exception $e) {
            return 'N/A';
        }
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }
}