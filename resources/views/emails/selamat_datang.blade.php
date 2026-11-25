<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang</title>
</head>
<body style="margin:0;padding:24px;background:#f4f7f5;font-family:Arial,Helvetica,sans-serif;color:#17251f;">
    {{-- Versi HTML biasa, disimpan sebagai pembanding untuk Tugas 5 (versi Markdown: selamat-datang.blade.php). --}}
    <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table width="560" cellpadding="0" cellspacing="0" role="presentation"
                       style="max-width:560px;width:100%;background:#ffffff;border-radius:12px;overflow:hidden;">
                    <tr>
                        <td style="background:#286b4c;padding:22px 28px;color:#ffffff;font-size:22px;font-weight:bold;">
                            Kos<span style="color:#b5e3c3;">Jos.</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:28px;">
                            <h2 style="margin:0 0 12px;font-size:20px;">Halo {{ $user->name }},</h2>
                            <p style="margin:0 0 16px;line-height:1.7;">
                                Terima kasih telah mendaftar di <b>{{ config('app.name') }}</b> menggunakan akun Google
                                (<b>{{ $user->email }}</b>).
                            </p>
                            <p style="margin:0 0 16px;line-height:1.7;">
                                Mulai sekarang kamu dapat login cukup dengan menekan tombol <b>Login dengan Google</b>
                                tanpa perlu mengingat password.
                            </p>
                            <p>
                                <a href="{{ route('dashboard') }}"
                                   style="background:#214e39;color:#fff;padding:10px 18px;border-radius:8px;text-decoration:none;">
                                    Buka Dashboard
                                </a>
                            </p>
                            <br>
                            <p style="margin:0;">Salam,<br><b>Tim {{ config('app.name') }}</b></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
