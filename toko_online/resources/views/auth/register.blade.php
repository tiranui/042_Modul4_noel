@extends('layouts.app')

@section('konten')
<div style="max-width:460px; margin:auto;">
    <h2>Daftar Akun</h2>

    @if ($errors->any())
        <div class="flash error">
            <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Username</label>
        <input type="text" name="username" value="{{ old('username') }}" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" required>

        <label>No. HP (opsional)</label>
        <input type="text" name="no_hp" value="{{ old('no_hp') }}">

        <label>Alamat (opsional)</label>
        <textarea name="alamat" rows="2">{{ old('alamat') }}</textarea>

        <button class="btn btn-primary" type="submit" style="margin-top:14px; width:100%;">Daftar</button>
    </form>

    <p style="margin-top:16px; text-align:center;">
        Sudah punya akun? <a href="{{ route('login') }}">Login</a>
    </p>
</div>
@endsection