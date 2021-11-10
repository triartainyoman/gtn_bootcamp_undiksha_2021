<?php

namespace App\Http\Controllers;

use App\Models\mProduksi;
use App\Models\mLokasi;
use Illuminate\Http\Request;

class Produksi extends Controller
{
    public function index()
    {
        $data_produksi = mProduksi::all();
        return view('produksi.produksiList', ['data_produksi' => $data_produksi]);
    }

    public function create()
    {
        $lokasi = mLokasi::all();
        $data = [
            'lokasi' => $lokasi,
        ];
        return view('produksi.produksiCreate', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'kode_produksi' => 'required',
            'tgl_mulai_produksi' => 'required',
            'tgl_selesai_produksi' => 'required',
            'id_lokasi' => 'required',
            'catatan' => 'required',
        ]);

        $kode_produksi = $request->input('kode_produksi');
        $tgl_mulai_produksi = date('Y-m-d', strtotime($request->input('tgl_mulai_produksi')));
        $tgl_selesai_produksi = date('Y-m-d', strtotime($request->input('tgl_selesai_produksi')));
        $id_lokasi = $request->input('id_lokasi');
        $catatan = $request->input('catatan');

        $data_insert = [
            'kode_produksi' => $kode_produksi,
            'tgl_mulai_produksi' => $tgl_mulai_produksi,
            'tgl_selesai_produksi' => $tgl_selesai_produksi,
            'id_lokasi' => $id_lokasi,
            'catatan' => $catatan,
        ];

        mProduksi::create($data_insert);

        // Redirect Laravel | NOTE: Sudah menggunakan ajax
        // return redirect(route('produksiList'));
    }

    public function edit($id)
    {
        $lokasi = mLokasi::all();
        $edit = mProduksi::where('id', $id)->first();

        $data = [
            'lokasi' => $lokasi,
            'edit' => $edit,
        ];

        return view('produksi.produksiEdit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_produksi' => 'required',
            'tgl_mulai_produksi' => 'required',
            'tgl_selesai_produksi' => 'required',
            'id_lokasi' => 'required',
            'catatan' => 'required',
        ]);

        $kode_produksi = $request->input('kode_produksi');
        $tgl_mulai_produksi = date('Y-m-d', strtotime($request->input('tgl_mulai_produksi')));
        $tgl_selesai_produksi = date('Y-m-d', strtotime($request->input('tgl_selesai_produksi')));
        $id_lokasi = $request->input('id_lokasi');
        $catatan = $request->input('catatan');

        $data_insert = [
            'kode_produksi' => $kode_produksi,
            'tgl_mulai_produksi' => $tgl_mulai_produksi,
            'tgl_selesai_produksi' => $tgl_selesai_produksi,
            'id_lokasi' => $id_lokasi,
            'catatan' => $catatan,
        ];

        mProduksi::where('id', $id)->update($data_insert);
    }

    public function delete($id)
    {
        mProduksi::where('id', $id)->delete();
    }
}
