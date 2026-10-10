<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Product::orderBy('id_barang')->get();
        return view('produk.index', compact('produk'));
    }
}