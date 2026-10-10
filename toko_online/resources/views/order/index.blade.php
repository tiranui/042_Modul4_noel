@extends('layouts.app')

@section('konten')
    <div class="card">
        <h2>Riwayat Pesanan</h2>

        @if ($orders->isEmpty())
            <p>Belum ada pesanan.</p>
            <a href="{{ route('produk.index') }}" class="btn btn-primary">Mulai belanja</a>
        @else
            <table>
                <tr>
                    <th>ID Order</th>
                    <th>Tanggal</th>
                    <th class="right">Total</th>
                    <th class="right">Aksi</th>
                </tr>
                @foreach ($orders as $o)
                    <tr>
                        <td><code>{{ $o->id_order }}</code></td>
                        <td>{{ $o->tanggal_order->format('d M Y H:i') }}</td>
                        <td class="right">{{ rupiah($o->total_harga) }}</td>
                        <td class="right">
                            <a href="{{ route('order.show', $o->id_order) }}"
                               class="btn btn-primary">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>
@endsection