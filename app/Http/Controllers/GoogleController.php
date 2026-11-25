<?php

namespace App\Http\Controllers;

use App\Jobs\KirimEmailSelamatDatang;
use App\Models\User;
use App\Notifications\UserBaruNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    // 1) Arahkan user ke halaman login Google.
    public function redirect()
    {
        $driver = Socialite::driver('google');

        // Tugas 2: parameter "hd" membuat Google hanya menampilkan akun dari domain tersebut.
        // Ini HANYA petunjuk tampilan; pemeriksaan sebenarnya ada di callback().
        if ($domain = $this->domainDiizinkan()) {
            $driver = $driver->with(['hd' => $domain]);
        }

        return $driver->redirect();
    }

    // 2) Google mengembalikan user ke sini setelah login berhasil.
    public function callback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Throwable $e) {
            report($e); // tetap dicatat di storage/logs agar mudah di-debug

            return redirect()->route('login')
                ->with('error', 'Login dengan Google gagal atau dibatalkan. Silakan coba lagi.');
        }

        // Tugas 2: tolak email di luar domain yang diizinkan. Wajib dicek di server,
        // karena parameter "hd" di atas bisa diubah-ubah oleh pengguna.
        $email = (string) $googleUser->getEmail();
        $domain = $this->domainDiizinkan();

        if ($domain && ! str_ends_with(strtolower($email), '@'.strtolower($domain))) {
            return redirect()->route('login')
                ->with('error', 'Hanya akun email @'.$domain.' yang boleh login.');
        }

        // 3) Cari user berdasarkan google_id, atau email (jika dulu daftar manual).
        $user = User::where('google_id', $googleUser->getId())
            ->orWhere('email', $email)
            ->first();

        $userBaru = false;

        if (! $user) {
            // 4a) Belum terdaftar -> buat akun baru (level mengikuti default database: 'user').
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $email,
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'email_verified_at' => now(),
            ]);

            $userBaru = true;
        } else {
            // 4b) Sudah terdaftar -> perbarui data Google-nya.
            $user->update([
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
            ]);
        }

        // 5) Login-kan user. Event Login akan memicu listener SendLoginNotification (Tugas 3).
        Auth::login($user, remember: true);
        $request->session()->regenerate(); // mencegah session fixation

        // 6) Khusus user baru: kirim email selamat datang & beri tahu semua admin lewat queue.
        if ($userBaru) {
            KirimEmailSelamatDatang::dispatch($user);

            $admins = User::where('level', 'admin')->get();
            Notification::send($admins, new UserBaruNotification($user));
        }

        return redirect()->intended(route('dashboard'))
            ->with('success', 'Selamat datang, '.$user->name.'!');
    }

    private function domainDiizinkan(): ?string
    {
        $domain = trim((string) config('services.google.allowed_domain'));

        return $domain !== '' ? $domain : null;
    }
}
