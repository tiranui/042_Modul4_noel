@extends('layouts.app')

@section('konten')
    <div class="card">
        <h2>Keranjang Belanja</h2>

        @if (empty($items))
            <p>Keranjang kosong.</p>
            <a href="{{ route('produk.index') }}" class="btn btn-primary">Kembali ke daftar produk</a>
        @else
            <table>
                @foreach ($items as $item)
                    <tr>
                        <td>
                            <strong>{{ $item['nama'] }}</strong><br>
                            <span style="color:#666; font-size:13px;">
                                {{ rupiah($item['harga']) }} x {{ $item['jumlah'] }}
                                = {{ rupiah($item['subtotal']) }}
                            </span>
                        </td>
                        <td class="right qty">
                            <form method="POST" action="{{ route('keranjang.ubah', [$item['id'], 'kurang']) }}">
                                @csrf <button class="btn btn-secondary" type="submit">−</button>
                            </form>
                            <strong>{{ $item['jumlah'] }}</strong>
                            <form method="POST" action="{{ route('keranjang.ubah', [$item['id'], 'tambah']) }}">
                                @csrf <button class="btn btn-secondary" type="submit">+</button>
                            </form>
                            <form method="POST" action="{{ route('keranjang.hapus', $item['id']) }}">
                                @csrf <button class="btn btn-danger" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>

            <hr style="margin:16px 0; border:0; border-top:1px solid #eee;">

            <p class="total-row right">Total: {{ rupiah($total) }}</p>

            <div style="display:flex; gap:10px; margin-top:14px;">
                <a href="{{ route('produk.index') }}" class="btn btn-secondary">Lanjut belanja</a>
                <form method="POST" action="{{ route('keranjang.kosongkan') }}">
                    @csrf <button class="btn btn-danger" type="submit">Kosongkan</button>
                </form>
                <a href="{{ route('checkout.form') }}" class="btn btn-primary" style="margin-left:auto;">
                    Checkout &raquo;
                </a>
            </div>
        @endif
    </div>
@endsection