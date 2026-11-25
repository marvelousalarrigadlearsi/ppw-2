<?php

namespace App\Jobs;

use App\Mail\SelamatDatangMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class KirimEmailSelamatDatang implements ShouldQueue
{
    use Queueable;

    public $tries = 3; // dicoba ulang maksimal 3 kali jika gagal

    public function __construct(public User $user)
    {
    }

    // Method yang dijalankan oleh queue worker.
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new SelamatDatangMail($this->user));
    }
}
