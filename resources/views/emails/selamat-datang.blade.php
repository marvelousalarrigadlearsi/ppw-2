<x-mail::message>
# Halo {{ $user->name }},

Terima kasih telah mendaftar di **{{ config('app.name') }}** menggunakan akun Google (**{{ $user->email }}**).

Mulai sekarang kamu dapat login cukup dengan menekan tombol **Login dengan Google** tanpa perlu mengingat password.

<x-mail::button :url="route('dashboard')">
Buka Dashboard
</x-mail::button>

Salam,<br>
**Tim {{ config('app.name') }}**
</x-mail::message>
