<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Berhasil</title>
</head>
<body style="margin:0;padding:24px;background:#f4f7f5;font-family:Arial,Helvetica,sans-serif;color:#17251f;">
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
                                Anda baru saja login ke <b>{{ config('app.name') }}</b>
                                dengan akun <b>{{ $user->email }}</b>.
                            </p>

                            <table width="100%" cellpadding="8" cellspacing="0" role="presentation"
                                   style="background:#f4f7f5;border-radius:8px;font-size:14px;">
                                <tr>
                                    <td style="color:#718078;width:90px;">Waktu</td>
                                    <td>{{ $waktu }}</td>
                                </tr>
                                <tr>
                                    <td style="color:#718078;">Alamat IP</td>
                                    <td>{{ $ip }}</td>
                                </tr>
                                <tr>
                                    <td style="color:#718078;">Perangkat</td>
                                    <td>{{ $perangkat }}</td>
                                </tr>
                            </table>

                            <p style="margin:20px 0 0;line-height:1.7;font-size:14px;">
                                Jika ini memang Anda, abaikan email ini. Jika bukan, segera ganti password
                                akun Anda.
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