<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

// Tugas 3: dikirim setiap kali user login. `ShouldQueue` membuat email
// otomatis masuk antrean (diproses oleh `php artisan queue:work`).
class LoginBaruMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public string $waktu,
        public string $ip,
        public string $perangkat,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Login ke '.config('app.name').' berhasil',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.login-baru',
            with: [
                'user' => $this->user,
                'waktu' => $this->waktu,
                'ip' => $this->ip,
                'perangkat' => $this->perangkat,
            ],
        );
    }
}
