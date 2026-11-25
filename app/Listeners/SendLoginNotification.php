<?php

namespace App\Listeners;

use App\Jobs\SendLoginNotificationMailJob;
use Illuminate\Auth\Events\Login;

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

        // Diproses di background oleh queue worker, jadi login tidak menunggu pengiriman email.
        SendLoginNotificationMailJob::dispatch(
            $user,
            $waktu,
            (string) $request->ip(),
            (string) ($request->userAgent() ?: 'Tidak diketahui'),
        );
    }
}