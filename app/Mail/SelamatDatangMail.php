<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SelamatDatangMail extends Mailable
{
    use Queueable, SerializesModels;

    // Data user dikirim lewat constructor agar bisa dipakai di view email.
    public function __construct(public User $user)
    {
    }

    // Envelope = "amplop": subjek, pengirim, dll.
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Selamat Datang di '.config('app.name'),
        );
    }

    // Content = isi email.
    // Tugas 5: memakai Markdown Mailable (parameter `markdown`), bukan `view`.
    // Untuk membandingkan dengan versi HTML biasa, ganti menjadi:
    //   view: 'emails.selamat_datang'
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.selamat-datang',
            with: [
                'user' => $this->user,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
