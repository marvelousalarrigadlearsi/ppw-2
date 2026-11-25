<?php

namespace App\Listeners;

use App\Mail\LoginBaruMail;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Mail;

class SendLoginNotification
{
    public function handle(Login $event): void
    {
        $request = request();

        // Kirim hanya saat login lewat form (ada password) atau lewat callback Google,
        // bukan saat sesi dipulihkan dari cookie "remember me".
        $loginForm = $request->isMethod('post') && $request->filled('password');
        $loginGoogle = $request->routeIs('google.callback');

        if (! $loginForm && ! $loginGoogle) {
            return;
        }

        $user = $event->user;

        if (empty($user->email)) {
            return;
        }

        $waktu = now('Asia/Jakarta')->locale('id')->translatedFormat('d F Y, H:i') . ' WIB';

        // LoginBaruMail memakai ShouldQueue, jadi email diproses di background oleh queue worker.
        Mail::to($user->email)->send(new LoginBaruMail(
            $user,
            $waktu,
            (string) $request->ip(),
            (string) ($request->userAgent() ?: 'Tidak diketahui'),
        ));
    }
}
