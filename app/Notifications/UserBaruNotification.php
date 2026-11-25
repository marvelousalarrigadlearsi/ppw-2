<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserBaruNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public User $userBaru)
    {
    }

    // Kirim lewat 2 jalur sekaligus: email dan database (tabel notifications).
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    // Isi notifikasi versi email.
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pengguna Baru Mendaftar via Google')
            ->greeting('Halo, '.$notifiable->name.'!')
            ->line('Ada pengguna baru yang mendaftar menggunakan akun Google:')
            ->line('Nama : '.$this->userBaru->name)
            ->line('Email : '.$this->userBaru->email)
            ->action('Buka Dashboard', route('dashboard'))
            ->line('Terima kasih.');
    }

    // Isi notifikasi versi database (disimpan sebagai JSON di kolom data).
    public function toArray(object $notifiable): array
    {
        return [
            'user_id' => $this->userBaru->id,
            'nama' => $this->userBaru->name,
            'email' => $this->userBaru->email,
            'pesan' => 'Pengguna baru mendaftar via Google: '.$this->userBaru->name,
        ];
    }
}
