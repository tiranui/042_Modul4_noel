@extends('layouts.app')

@section('konten')
    <div class="card">
        <h2>Detail Pesanan</h2>

        <p><strong>ID Order:</strong> <code>{{ $order->id_order }}</code></p>
        <p><strong>Tanggal:</strong> {{ $order->tanggal_order->format('d M Y H:i') }}</p>
        <p><strong>Alamat:</strong> {{ $order->alamat_pengiriman }}</p>

        <table style="margin-top:14px;">
            <tr>
                <th>Barang</th>
                <th class="right">Harga</th>
                <th class="right">Jumlah</th>
                <th class="right">Subtotal</th>
            </tr>
            @foreach ($order->details as $d)
                <tr>
                    <td>{{ $d->product->nama_barang ?? '(produk dihapus)' }}</td>
                    <td class="right">{{ rupiah($d->harga_satuan) }}</td>
                    <td class="right">{{ $d->jumlah_beli }}</td>
                    <td class="right">{{ rupiah($d->harga_satuan * $d->jumlah_beli) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" class="right total-row">Total</td>
                <td class="right total-row">{{ rupiah($order->total_harga) }}</td>
            </tr>
        </table>

        <a href="{{ route('order.index') }}" class="btn btn-secondary" style="margin-top:16px;">
            &laquo; Kembali ke daftar pesanan
        </a>
    </div>
@endsection