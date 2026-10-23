@extends('layouts.app')

@section('konten')
<h2>Kelola Role User</h2>

@if (session('status'))
    <div class="flash sukses">{{ session('status') }}</div>
@endif

@if ($errors->any())
    <div class="flash error">
        <ul style="margin:0; padding-left:18px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <p style="margin-top:0; color:#666; font-size:14px;">
        Total user: <strong>{{ $users->count() }}</strong>
    </p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Role</th>
                <th>Ubah Role</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id_user }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->nama_lengkap }}</td>
                    <td><strong>{{ $user->role }}</strong></td>
                    <td>
                        @if ($user->role === 'admin')
                            <span class="habis">Tidak dapat diubah (akun admin)</span>
                        @else
                            <form action="{{ route('admin.users.role.update', $user) }}"
                                  method="POST"
                                  style="display:flex; gap:8px; align-items:center;">
                                @csrf
                                @method('PATCH')

                                <select name="role" style="width:auto; padding:6px 10px;">
                                    <option value="customer" @selected($user->role === 'customer')>customer</option>
                                    <option value="staff"    @selected($user->role === 'staff')>staff</option>
                                </select>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center; color:#888; padding:20px;">
                        Belum ada user di database. Jalankan <code>php artisan db:seed</code>.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection