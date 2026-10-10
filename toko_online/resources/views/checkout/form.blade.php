@extends('layouts.app')

@section('konten')
    <div class="card">
        <h2>Checkout</h2>

        <table>
            @foreach ($items as $i)
                <tr>
                    <td>{{ $i['nama'] }}</td>
                    <td class="right">{{ rupiah($i['harga']) }} x {{ $i['jumlah'] }}</td>
                    <td class="right">{{ rupiah($i['subtotal']) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2" class="right total-row">Total</td>
                <td class="right total-row">{{ rupiah($total) }}</td>
            </tr>
        </table>

        <form method="POST" action="{{ route('checkout.proses') }}" style="margin-top:20px;">
            @csrf
            <label>Alamat Pengiriman</label>
            <textarea name="alamat_pengiriman" rows="3" required>{{ old('alamat_pengiriman', auth()->user()->alamat) }}</textarea>

            @error('alamat_pengiriman')
                <div class="flash error" style="margin-top:8px;">{{ $message }}</div>
            @enderror

            <button class="btn btn-primary" type="submit" style="margin-top:14px;">
                Konfirmasi Pesanan
            </button>
            <a href="{{ route('keranjang.index') }}" class="btn btn-secondary" style="margin-top:14px;">Batal</a>
        </form>
    </div>
@endsection