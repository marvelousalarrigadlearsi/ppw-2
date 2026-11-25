<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoginNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public string $waktu;
    public string $ip;
    public string $perangkat;

    public function __construct(User $user, string $waktu, string $ip, string $perangkat)
    {
        $this->user = $user;
        $this->waktu = $waktu;
        $this->ip = $ip;
        $this->perangkat = $perangkat;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Login ke ' . config('app.name') . ' berhasil',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.login_notification',
            with: [
                'user' => $this->user,
                'waktu' => $this->waktu,
                'ip' => $this->ip,
                'perangkat' => $this->perangkat,
            ],
        );
    }
}