<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        $barang = Barang::orderBy('id')->get();
        $jumlahItem = $this->jumlahItem();

        return view('barang.index', compact('barang', 'jumlahItem'));
    }

    public function keranjang()
    {
        $keranjang = session('keranjang', []);
        $items = [];
        $total = 0;

        foreach ($keranjang as $id => $jumlah) {
            $produk = Barang::find($id);
            if (!$produk) continue;

            $subtotal = $produk->harga * $jumlah;
            $total += $subtotal;

            $items[] = [
                'id'       => $id,
                'nama'     => $produk->nama,
                'harga'    => $produk->harga,
                'stok'     => $produk->stok,
                'jumlah'   => $jumlah,
                'subtotal' => $subtotal,
            ];
        }

        $jumlahItem = $this->jumlahItem();

        return view('keranjang.index', compact('items', 'total', 'jumlahItem'));
    }

    public function tambah(Request $request, $id)
    {
        $produk = Barang::findOrFail($id);

        if ($produk->stok <= 0) {
            return back()->with('error', 'Stok barang habis.');
        }

        $keranjang = session('keranjang', []);
        $jumlahBaru = ($keranjang[$id] ?? 0) + 1;

        if ($jumlahBaru > $produk->stok) {
            return back()->with('error', 'Jumlah melebihi stok yang tersedia.');
        }

        $keranjang[$id] = $jumlahBaru;
        session(['keranjang' => $keranjang]);

        return back()->with('sukses', $produk->nama . ' ditambahkan ke keranjang.');
    }

    public function ubah(Request $request, $id, $aksi)
    {
        $produk = Barang::findOrFail($id);
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

    private function jumlahItem(): int
    {
        $keranjang = session('keranjang', []);
        return array_sum($keranjang);
    }
}