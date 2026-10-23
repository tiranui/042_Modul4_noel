@php
    $user    = auth()->user();
    $isAdmin = $user && $user->role === 'admin';
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Toko Online</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: system-ui, sans-serif; background:#f4f6f8; margin:0; padding:20px; color:#222; }
        .container { max-width:960px; margin:auto; }

        /* NAVBAR default (biru) */
        .navbar { display:flex; justify-content:space-between; align-items:center;
                  background:#1a57a0; color:#fff; padding:14px 22px; border-radius:10px;
                  margin-bottom:20px; transition:background .2s; }
        /* NAVBAR admin (orange) */
        .navbar.admin { background:#e67e22; }

        .navbar h1 { margin:0; font-size:20px; }
        .navbar a { color:#fff; text-decoration:none; margin-left:16px; font-size:14px; }
        .navbar a:hover { text-decoration:underline; }

        .badge { background:#f0b400; color:#222; padding:2px 9px;
                 border-radius:10px; font-size:12px; font-weight:600; }
        .badge-akun { background:rgba(255,255,255,.22); color:#fff; padding:4px 10px;
                      border-radius:12px; font-size:13px; margin-left:12px; }
        .badge-akun .role { opacity:.8; font-weight:600; }
        .badge-guest { background:rgba(0,0,0,.25); color:#fff; padding:4px 10px;
                       border-radius:12px; font-size:13px; margin-left:8px; }

        .card { background:#fff; padding:22px 26px; border-radius:10px;
                box-shadow:0 2px 10px rgba(0,0,0,.06); margin-bottom:18px; }
        h2 { margin-top:0; }
        label { display:block; margin:10px 0 4px; font-weight:600; font-size:14px; }
        input, textarea, select { width:100%; padding:9px 11px; border:1px solid #ccc;
                                  border-radius:6px; font-family:inherit; font-size:14px; }
        .btn { display:inline-block; padding:8px 14px; border:0; border-radius:6px;
               cursor:pointer; font-size:13px; text-decoration:none; color:#fff;
               font-family:inherit; }
        .btn-primary { background:#1a57a0; }
        .btn-secondary { background:#6c757d; }
        .btn-danger { background:#c0392b; }
        .btn-success { background:#1a7f37; }
        .btn-warning { background:#e67e22; }
        .flash { padding:10px 14px; border-radius:6px; margin-bottom:14px; font-size:14px; }
        .flash.sukses { background:#e6f4ea; color:#1a7f37; }
        .flash.error  { background:#fdecea; color:#b3261e; }
        .flash.info   { background:#e7f1ff; color:#1a57a0; }

        .grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(180px, 1fr)); gap:14px; }
        .produk { background:#fff; border-radius:10px; padding:14px; text-align:center;
                  box-shadow:0 1px 4px rgba(0,0,0,.06); display:flex; flex-direction:column; }
        .produk img { width:100%; height:120px; object-fit:cover; border-radius:6px; }
        .produk h3 { font-size:15px; margin:10px 0 4px; }
        .produk .harga { color:#1a57a0; font-weight:700; }
        .produk .stok { color:#666; font-size:12px; margin-bottom:8px; }
        .produk .btn { width:100%; margin-top:auto; }
        .habis { color:#c0392b; font-weight:600; font-size:13px; margin-top:auto; }

        table { width:100%; border-collapse:collapse; }
        td, th { padding:10px 8px; border-bottom:1px solid #eee; text-align:left; vertical-align:middle; }
        .right { text-align:right; }
        .qty { display:inline-flex; align-items:center; gap:6px; }
        .qty form { display:inline; }
        .qty button { width:28px; height:28px; padding:0; font-size:15px; line-height:1; }
        .total-row { font-size:18px; font-weight:700; }
    </style>
</head>
<body>
<div class="container">

    {{-- ===== NAVBAR ===== --}}
    <div class="navbar {{ $isAdmin ? 'admin' : '' }}">
        <h1><a href="{{ route('produk.index') }}" style="margin:0; font-size:20px;">🛒 Toko Online</a></h1>
        <div>
            <a href="{{ route('produk.index') }}">Produk</a>

            @auth
                @if (auth()->user()->role === 'customer')
                    <a href="{{ route('keranjang.index') }}">
                        Keranjang <span class="badge">{{ $jumlahKeranjang ?? 0 }}</span>
                    </a>
                    <a href="{{ route('order.index') }}">Pesanan Saya</a>
                @endif

                @can('manage-roles')
                    <a href="{{ route('admin.users.index') }}">Kelola User</a>
                @endcan

                {{-- Indikator akun login --}}
                <span class="badge-akun">
                    {{ auth()->user()->nama_lengkap }}
                    <span class="role">· {{ auth()->user()->role }}</span>
                </span>

                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit"
                            class="btn {{ $isAdmin ? 'btn-warning' : 'btn-danger' }}"
                            style="margin-left:8px;">Logout</button>
                </form>
            @else
                {{-- Indikator guest --}}
                <span class="badge-guest">Guest · belum login</span>
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Daftar</a>
            @endauth
        </div>
    </div>

    {{-- ===== FLASH ===== --}}
    @if (session('sukses'))
        <div class="flash sukses">{{ session('sukses') }}</div>
    @endif
    @if (session('status'))
        <div class="flash info">{{ session('status') }}</div>
    @endif
    @if (session('error'))
        <div class="flash error">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        <div class="flash error">
            <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('konten')
</div>
</body>
</html>