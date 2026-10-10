<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body { font-family: system-ui, sans-serif; background:#f4f6f8; padding:40px; }
        .card { max-width:520px; margin:auto; background:#fff; padding:28px;
                border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,.08); }
        .top { display:flex; justify-content:space-between; align-items:center; }
        h1 { margin:0; font-size:22px; }
        button { padding:8px 14px; border:0; background:#c0392b; color:#fff;
                 border-radius:6px; cursor:pointer; }
        .info { margin-top:20px; color:#333; }
        .badge { display:inline-block; background:#eef4fc; color:#1a57a0;
                 padding:2px 10px; border-radius:10px; font-size:13px; }
    </style>
</head>
<body>
<div class="card">
    <div class="top">
        <h1>Dashboard</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <div class="info">
        <p>Selamat datang, <strong>{{ auth()->user()->nama_lengkap }}</strong>!</p>
        <p>Halaman ini hanya bisa dibuka setelah login.</p>
        <p>Username: <span class="badge">{{ auth()->user()->username }}</span></p>
    </div>
</div>
</body>
</html>