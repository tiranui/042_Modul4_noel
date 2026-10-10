@extends('layouts.app')

@section('konten')
    <h2>Daftar Barang</h2>

    <table>
        @forelse ($barang as $b)
            <tr>
                <td>{{ $b->nama }}</td>
                <td class="harga">{{ rupiah($b->harga) }}</td>
                <td class="harga">Stok: {{ $b->stok }}</td>
                <td class="right">
                    @if ($b->stok > 0)
                        <form method="POST" action="{{ route('keranjang.tambah', $b->id) }}">
                            @csrf
                            <button class="btn btn-tambah" type="submit">
                                Masukkan ke keranjang
                            </button>
                        </form>
                    @else
                        <span class="harga">Stok habis</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="4">Belum ada barang.</td></tr>
        @endforelse
    </table>
@endsection