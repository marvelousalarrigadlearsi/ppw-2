
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KosJos') - KosJos</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Inter, "Segoe UI", Arial, sans-serif;
            color: #17251f;
            background: #f4f7f4;
            min-height: 100vh;
        }
        .auth-page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
        .auth-visual {
            padding: 48px;
            background: #183e30;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }
        .auth-visual::before, .auth-visual::after {
            content: "";
            position: absolute;
            border: 1px solid #ffffff24;
            border-radius: 50%;
            width: 380px;
            height: 380px;
        }
        .auth-visual::before { right: -130px; top: 20%; }
        .auth-visual::after { right: -40px; top: 30%; width: 200px; height: 200px; }
        .brand { font-size: 25px; font-weight: 800; letter-spacing: -1px; }
        .brand span { color: #b5e3c3; }
        .visual-content { max-width: 480px; position: relative; z-index: 1; }
        .visual-content .eyebrow {
            color: #b5e3c3;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-size: 11px;
            font-weight: 700;
        }
        .visual-content h1 {
            font-size: clamp(38px, 4.5vw, 64px);
            line-height: 1.08;
            letter-spacing: -2px;
            margin: 20px 0;
        }
        .visual-content p { color: #d1ded6; line-height: 1.8; max-width: 390px; }
        .visual-footer { color: #c1d2c8; font-size: 12px; }
        .auth-main {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
        }
        .auth-card { width: 100%; max-width: 410px; }
        .mobile-brand { display: none; }
        .auth-card h2 { font-size: 32px; letter-spacing: -1px; margin: 0 0 8px; }
        .subtitle { color: #718078; font-size: 14px; margin: 0 0 30px; line-height: 1.7; }
        .field { margin-bottom: 19px; }
        .field label { display: block; font-size: 13px; font-weight: 700; margin-bottom: 8px; }
        .field input {
            width: 100%;
            padding: 14px 15px;
            border: 1px solid #dce5de;
            background: white;
            border-radius: 12px;
            font-size: 14px;
            outline: none;
            transition: .2s;
        }
        .field input:focus {
            border-color: #286b4c;
            box-shadow: 0 0 0 3px #286b4c15;
        }
        .primary-btn {
            width: 100%;
            border: 0;
            border-radius: 12px;
            background: #214e39;
            color: white;
            font-size: 14px;
            font-weight: 700;
            padding: 15px;
            cursor: pointer;
            transition: .2s;
        }
        .primary-btn:hover { background: #163b2a; transform: translateY(-1px); }
        .auth-switch { text-align: center; margin-top: 24px; font-size: 13px; color: #718078; }
        .auth-switch a { color: #245a3e; font-weight: 700; text-decoration: none; }
        .error { color: #c0392b; font-size: 12px; margin-top: 7px; }
        .alert {
            background: #fff0ed;
            color: #a93226;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 13px;
            margin-bottom: 20px;
        }
        @media(max-width: 760px) {
            .auth-page { grid-template-columns: 1fr; }
            .auth-visual { display: none; }
            .auth-main { padding: 35px 22px; }
            .mobile-brand { display: block; margin-bottom: 45px; }
            .auth-card h2 { font-size: 29px; }
        }
        
.action-link {
    display: inline-block;
    padding: 12px 20px;
    background: #214e39;
    color: white;
    text-decoration: none;
    border-radius: 10px;
    font-weight: 600;
    transition: background 0.2s ease;
}

.action-link:hover {
    background: #163b2a;
}

    </style>
</head>
<body>
    @yield('content')
</body>
</html>
