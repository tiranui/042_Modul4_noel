@extends('layouts.app')

@section('konten')
<div style="max-width:400px; margin:auto;">
    <h2>Login</h2>
    <p style="color:#666;">Masuk untuk berbelanja</p>

    @if (session('error'))
        <div class="flash error">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label>Username</label>
        <input type="text" name="username" value="{{ old('username') }}" required autofocus>

        <label>Password</label>
        <input type="password" name="password" required>

        <button class="btn btn-primary" type="submit" style="margin-top:14px; width:100%;">Masuk</button>
    </form>

    <p style="margin-top:16px; text-align:center;">
        Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
    </p>
</div>
@endsection