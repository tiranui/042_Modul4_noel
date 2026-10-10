<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body { font-family: system-ui, sans-serif; background:#f4f6f8; padding:40px; }
        .card { max-width:380px; margin:auto; background:#fff; padding:28px;
                border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,.08); }
        h1 { margin:0 0 4px; }
        .sub { color:#666; font-size:14px; margin-bottom:20px; }
        label { display:block; margin:12px 0 4px; font-weight:600; font-size:14px; }
        input { width:100%; padding:9px 11px; border:1px solid #ccc;
                border-radius:6px; box-sizing:border-box; }
        button { margin-top:18px; width:100%; padding:10px; border:0;
                 background:#1a57a0; color:#fff; border-radius:6px;
                 font-size:15px; cursor:pointer; }
        .err { background:#fdecea; color:#b3261e; padding:10px 12px;
               border-radius:6px; font-size:14px; margin-bottom:8px; }
    </style>
</head>
<body>
<div class="card">
    <h1>Login</h1>
    <p class="sub">Masuk untuk membuka dashboard</p>

    @if (session('error'))
        <div class="err">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="username">Username</label>
        <input id="username" type="text" name="username"
               value="{{ old('username') }}" required autofocus>

        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>

        <button type="submit">Masuk</button>
    </form>
</div>
</body>
</html>