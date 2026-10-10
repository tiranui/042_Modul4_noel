<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = session('keranjang', []);
        $items = [];
        $total = 0;

        foreach ($keranjang as $id => $jumlah) {
            $produk = Product::find($id);
            if (!$produk) continue;

            $subtotal = $produk->harga * $jumlah;
            $total += $subtotal;

            $items[] = [
                'id'       => $id,
                'nama'     => $produk->nama_barang,
                'harga'    => $produk->harga,
                'stok'     => $produk->stok,
                'jumlah'   => $jumlah,
                'subtotal' => $subtotal,
            ];
        }

        return view('keranjang.index', compact('items', 'total'));
    }

    public function tambah(Request $request, $id)
    {
        $produk = Product::findOrFail($id);

        if ($produk->stok <= 0) {
            return back()->with('error', 'Stok produk habis.');
        }

        $keranjang = session('keranjang', []);
        $jumlahBaru = ($keranjang[$id] ?? 0) + 1;

        if ($jumlahBaru > $produk->stok) {
            return back()->with('error', 'Jumlah melebihi stok tersedia (' . $produk->stok . ').');
        }

        $keranjang[$id] = $jumlahBaru;
        session(['keranjang' => $keranjang]);

        return back()->with('sukses', $produk->nama_barang . ' ditambahkan ke keranjang.');
    }

    public function ubah(Request $request, $id, $aksi)
    {
        $produk = Product::findOrFail($id);
        $keranjang = session('keranjang', []);
        $jumlah = $keranjang[$id] ?? 0;

        if ($aksi === 'tambah') {
            $jumlah++;
            if ($jumlah > $produk->stok) {
                return back()->with('error', 'Jumlah melebihi stok.');
            }
        } elseif ($aksi === 'kurang') {
            $jumlah--;
        } else {
            return back();
        }

        if ($jumlah <= 0) {
            unset($keranjang[$id]);
        } else {
            $keranjang[$id] = $jumlah;
        }

        session(['keranjang' => $keranjang]);
        return back();
    }

    public function hapus($id)
    {
        $keranjang = session('keranjang', []);
        unset($keranjang[$id]);
        session(['keranjang' => $keranjang]);
        return back()->with('sukses', 'Item dihapus dari keranjang.');
    }

    public function kosongkan()
    {
        session()->forget('keranjang');
        return redirect()->route('keranjang.index')
                         ->with('sukses', 'Keranjang dikosongkan.');
    }
}