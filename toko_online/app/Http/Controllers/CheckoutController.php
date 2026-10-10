<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function form()
    {
        $keranjang = session('keranjang', []);

        if (empty($keranjang)) {
            return redirect()->route('keranjang.index')
                             ->with('error', 'Keranjang kosong. Tambahkan produk dulu.');
        }

        $items = [];
        $total = 0;
        foreach ($keranjang as $id => $jumlah) {
            $p = Product::find($id);
            if (!$p) continue;
            $subtotal = $p->harga * $jumlah;
            $total += $subtotal;
            $items[] = [
                'id'       => $id,
                'nama'     => $p->nama_barang,
                'harga'    => $p->harga,
                'jumlah'   => $jumlah,
                'subtotal' => $subtotal,
            ];
        }

        return view('checkout.form', compact('items', 'total'));
    }

    // Proses checkout
    public function proses(Request $request)
    {
        $request->validate([
            'alamat_pengiriman' => ['required', 'string', 'max:500'],
        ]);

        $keranjang = session('keranjang', []);

        if (empty($keranjang)) {
            return redirect()->route('keranjang.index')
                             ->with('error', 'Keranjang kosong.');
        }

        try {
            DB::beginTransaction();

            $total = 0;
            $detailData = [];

            foreach ($keranjang as $id => $jumlah) {
                $produk = Product::lockForUpdate()->find($id);

                if (!$produk) {
                    throw new \Exception("Produk $id tidak ditemukan.");
                }
                if ($jumlah > $produk->stok) {
                    throw new \Exception("Stok {$produk->nama_barang} tidak cukup. Sisa: {$produk->stok}.");
                }

                $subtotal = $produk->harga * $jumlah;
                $total += $subtotal;

                $detailData[] = [
                    'id_barang'    => $id,
                    'harga_satuan' => $produk->harga,
                    'jumlah_beli'  => $jumlah,
                    'produk'       => $produk,
                ];
            }

            $order = Order::create([
                'id_order'          => generate_id_order(),
                'id_user'           => auth()->user()->id_user,
                'tanggal_order'     => now(),
                'total_harga'       => $total,
                'alamat_pengiriman' => $request->alamat_pengiriman,
            ]);

            foreach ($detailData as $d) {
                OrderDetail::create([
                    'id_order'     => $order->id_order,
                    'id_barang'    => $d['id_barang'],
                    'harga_satuan' => $d['harga_satuan'],
                    'jumlah_beli'  => $d['jumlah_beli'],
                ]);

                $d['produk']->decrement('stok', $d['jumlah_beli']);
            }

            session()->forget('keranjang');

            DB::commit();

            return redirect()->route('order.show', $order->id_order)
                             ->with('sukses', 'Pesanan berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }
}