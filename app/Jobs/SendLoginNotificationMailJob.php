<?php

namespace App\Jobs;

use App\Mail\LoginNotificationMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendLoginNotificationMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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

    public function handle(): void
    {
        Mail::to($this->user->email)
            ->send(new LoginNotificationMail($this->user, $this->waktu, $this->ip, $this->perangkat));
    }
}