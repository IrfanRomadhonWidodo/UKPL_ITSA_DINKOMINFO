<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Persetujuan Akun oleh ITSA Dinkominfo')
            ->html("
                <p>Yth. <strong>{$this->user->name}</strong>,</p>
                <p>Dengan hormat,</p>
                <p>Kami informasikan bahwa akun Anda telah <strong>disetujui</strong> dan diaktifkan oleh <strong>Tim ITSA Dinkominfo</strong>.</p>
                <p>Silakan masuk ke sistem untuk mulai mengakses dan menggunakan layanan yang tersedia.</p>
                <p>Jika Anda membutuhkan bantuan lebih lanjut, jangan ragu untuk menghubungi kami.</p>
                <p>Terima kasih atas perhatian dan kerja sama Anda.</p>
                <p>Hormat kami,<br>Tim ITSA Dinkominfo</p>
            ");
    }
}

