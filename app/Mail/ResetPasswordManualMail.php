<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordManualMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;

    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function build()
    {
        $resetLink = url("/reset-password/{$this->token}?email=" . urlencode($this->user->email));

        return $this->subject('Permintaan Pengaturan Ulang Kata Sandi Akun ITSA Dinkominfo')
            ->html("
                <p>Yth. <strong>{$this->user->name}</strong>,</p>
                <p>Kami telah menerima permintaan untuk melakukan pengaturan ulang (reset) kata sandi akun Anda pada sistem ITSA Dinkominfo.</p>
                <p>Silakan klik tautan di bawah ini untuk melanjutkan proses pengaturan ulang kata sandi Anda:</p>
                <p><a href=\"{$resetLink}\">Atur Ulang Kata Sandi</a></p>
                <p>Apabila Anda tidak pernah melakukan permintaan ini, mohon abaikan email ini. Tidak ada tindakan lebih lanjut yang diperlukan.</p>
                <p>Terima kasih atas perhatian Anda.</p>
                <p>Hormat kami,<br>Tim ITSA Dinkominfo</p>
            ");
    }
}
