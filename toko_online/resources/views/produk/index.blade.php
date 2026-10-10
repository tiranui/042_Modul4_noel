@extends('layouts.app')

@section('konten')
    <div class="card">
        <h2>Daftar Produk</h2>
        <p style="color:#666; font-size:14px;">
            Silakan pilih produk. Untuk berbelanja Anda harus login terlebih dahulu.
        </p>
    </div>

    <div class="grid">
        @foreach ($produk as $p)
            <div class="produk">
                <img src="{{ $p->gambar ?: 'https://placehold.co/120x120?text=No+Image' }}"
                     alt="{{ $p->nama_barang }}">
                <h3>{{ $p->nama_barang }}</h3>
                <div class="harga">{{ rupiah($p->harga) }}</div>
                <div class="stok">Stok: {{ $p->stok }}</div>

                @auth
                    @if ($p->stok > 0)
                        <form method="POST" action="{{ route('keranjang.tambah', $p->id_barang) }}">
                            @csrf
                            <button class="btn btn-success" type="submit">+ Keranjang</button>
                        </form>
                    @else
                        <div class="habis">Stok Habis</div>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-secondary">Login untuk beli</a>
                @endauth
            </div>
        @endforeach
    </div>
@endsection