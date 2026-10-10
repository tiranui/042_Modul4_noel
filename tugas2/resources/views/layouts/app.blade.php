<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Toko Alat Tulis</title>
    <style>
        body { font-family: system-ui, sans-serif; background:#f4f6f8; padding:30px; color:#222; }
        .container { max-width:760px; margin:auto; background:#fff; padding:24px 28px;
                     border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,.08); }
        .header { display:flex; justify-content:space-between; align-items:center;
                  border-bottom:1px solid #eee; padding-bottom:12px; margin-bottom:18px; }
        .header h1 { margin:0; font-size:20px; }
        .header a { color:#1a57a0; text-decoration:none; }
        .header a:hover { text-decoration:underline; }
        .badge { background:#1a57a0; color:#fff; padding:2px 9px;
                 border-radius:10px; font-size:13px; }
        table { width:100%; border-collapse:collapse; }
        td { padding:10px 6px; border-bottom:1px solid #eee; vertical-align:middle; }
        .harga { color:#666; font-size:14px; }
        .right { text-align:right; }
        .btn { display:inline-block; padding:6px 12px; border:0; border-radius:6px;
               cursor:pointer; font-size:13px; text-decoration:none; color:#fff; }
        .btn-primary { background:#1a57a0; }
        .btn-secondary { background:#6c757d; }
        .btn-danger { background:#c0392b; }
        .btn-tambah { background:#1a7f37; }
        .flash { padding:10px 14px; border-radius:6px; margin-bottom:14px; font-size:14px; }
        .flash.sukses { background:#e6f4ea; color:#1a7f37; }
        .flash.error  { background:#fdecea; color:#b3261e; }
        .total { font-size:18px; font-weight:bold; }
        .qty { display:inline-flex; align-items:center; gap:6px; }
        .qty form { display:inline; }
        .qty button { width:26px; height:26px; padding:0; font-size:14px; line-height:1; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Toko Alat Tulis</h1>
        <a href="{{ route('keranjang.index') }}">
            Keranjang <span class="badge">{{ $jumlahItem ?? 0 }}</span>
        </a>
    </div>

    @if (session('sukses'))
        <div class="flash sukses">{{ session('sukses') }}</div>
    @endif
    @if (session('error'))
        <div class="flash error">{{ session('error') }}</div>
    @endif

    @yield('konten')
</div>
</body>
</html>