<?php

namespace App\Http\Controllers;

use App\Models\mProduksi;
use Illuminate\Http\Request;

class Produksi extends Controller
{
    public function index()
    {
        $data_produksi = mProduksi::all();
        return view('produksi.produksiList', ['data_produksi' => $data_produksi]);
    }
}
