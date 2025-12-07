<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Pemberitahuan Penolakan Akun oleh ITSA Dinkominfo')
            ->html("
                <p>Yth. <strong>{$this->user->name}</strong>,</p>
                <p>Dengan hormat,</p>
                <p>Kami informasikan bahwa permohonan pendaftaran akun Anda pada sistem <strong>ITSA Dinkominfo</strong> belum dapat disetujui pada saat ini.</p>
                <p>Apabila Anda memerlukan informasi lebih lanjut terkait alasan penolakan atau ingin mengajukan kembali, silakan menghubungi admin melalui kontak yang tersedia.</p>
                <p>Terima kasih atas perhatian dan pengertiannya.</p>
                <p>Hormat kami,<br>Tim ITSA Dinkominfo</p>
            ");
    }
}
