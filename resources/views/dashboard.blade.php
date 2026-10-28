
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - KosJos</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Inter, "Segoe UI", Arial, sans-serif;
            color: #1c2a22;
            background: #f5f7f5;
        }
        .topbar {
            background: white;
            border-bottom: 1px solid #e6ebe7;
            padding: 18px 5%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }
        .brand { font-size: 25px; font-weight: 800; letter-spacing: -1px; }
        .brand span { color: #40815d; }
        .topbar-right { display: flex; align-items: center; gap: 18px; }
        .user-name { font-size: 13px; color: #68766d; }
        .logout {
            border: 1px solid #dce5de;
            background: white;
            padding: 10px 15px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
        }
        .container { max-width: 1200px; padding: 42px 24px; margin: auto; }
        .welcome {
            background: #1e4935;
            color: white;
            border-radius: 24px;
            padding: 36px;
            position: relative;
            overflow: hidden;
        }
        .welcome::after {
            content: "";
            position: absolute;
            right: -60px;
            top: -130px;
            width: 340px;
            height: 340px;
            border: 1px solid #ffffff25;
            border-radius: 50%;
            box-shadow: 0 0 0 40px #ffffff08, 0 0 0 80px #ffffff08;
        }
        .welcome small {
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #b7dec5;
            font-weight: 700;
        }
        .welcome h1 {
            font-size: clamp(27px, 4vw, 42px);
            letter-spacing: -1.5px;
            margin: 14px 0 10px;
            position: relative;
            z-index: 1;
        }
        .welcome p { color: #d4e3d9; line-height: 1.7; margin: 0; position: relative; z-index: 1; }
        .section-title { font-size: 20px; margin: 34px 0 18px; letter-spacing: -.5px; }
        .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
        .stat {
            padding: 24px;
            background: white;
            border: 1px solid #e8ede9;
            border-radius: 18px;
        }
        .stat-label { font-size: 13px; color: #718078; }
        .stat-value { font-size: 34px; font-weight: 800; margin: 12px 0 6px; }
        .stat-note { font-size: 12px; color: #8b978f; }
        .actions { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        .action-card {
            background: white;
            border: 1px solid #e8ede9;
            border-radius: 18px;
            padding: 24px;
        }
        .action-card h3 { margin: 0 0 9px; }
        .action-card p { color: #718078; font-size: 14px; line-height: 1.7; }
        .action-link {
            display: inline-block;
            margin-top: 8px;
            background: #214e39;
            color: white;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
        }
        @media(max-width: 650px) {
            .topbar { padding: 16px 20px; }
            .user-name { display: none; }
            .container { padding: 25px 18px; }
            .welcome { padding: 26px 22px; }
            .stats { grid-template-columns: 1fr; }
            .actions { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="brand">Kos<span>Jos.</span></div>

        <div class="topbar-right">
            <span class="user-name">{{ auth()->user()->name }}</span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout" type="submit">Keluar ↗</button>
            </form>
        </div>
    </header>

    <main class="container">
        <section class="welcome">
            <small>Dashboard KosJos</small>
            <h1>Halo, {{ auth()->user()->name }}!</h1>
            <p>Selamat datang kembali. Yuk, kelola data kosmu dengan lebih mudah.</p>
        </section>

        <h2 class="section-title">Ringkasan kamar</h2>

        <section class="stats">
            <div class="stat">
                <div class="stat-label">Total kamar</div>
                <div class="stat-value">{{ $totalKamar }}</div>
                <div class="stat-note">Jumlah seluruh kamar terdaftar</div>
            </div>

            <div class="stat">
                <div class="stat-label">Kamar tersedia</div>
                <div class="stat-value">{{ $kamarTersedia }}</div>
                <div class="stat-note">Siap untuk ditempati</div>
            </div>

            <div class="stat">
                <div class="stat-label">Kamar terisi</div>
                <div class="stat-value">{{ $kamarTerisi }}</div>
                <div class="stat-note">Sedang ditempati</div>
            </div>
        </section>

        <h2 class="section-title">Akses cepat</h2>

        <section class="actions">
            <div class="action-card">
                <h3>Kelola kamar</h3>
                <p>Lihat daftar kamar, cari data, ubah informasi, atau tambahkan kamar baru.</p>
                <a class="action-link" href="{{ route('kamar.index') }}">Buka data kamar →</a>
            </div>

            <div class="action-card">
                <h3>Akun saya</h3>
                <p>Kamu sedang masuk sebagai {{ auth()->user()->name }} dengan email {{ auth()->user()->email }}.</p>
                <a class="action-link" href="{{ route('kamar.index') }}">Mulai mengelola kos →</a>
            </div>
        </section>
        

    </main>
</body>
</html>
