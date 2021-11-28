<?php

namespace App\Http\Controllers;

use App\Models\mBahan;
use App\Models\mBahanProduksi;
use App\Models\mDetailProduksi;
use App\Models\mLokasi;
use App\Models\mProduk;
use App\Models\mProduksi;
use App\Models\mKomposisiProduk;
use App\Models\mStokBahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $produk = mProduk::all();

        $data = [
            'lokasi' => $lokasi,
            'produk' => $produk,
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
            'id_produk' => 'required',
            'id_produk.*' => 'required',
            'qty_digunakan' => 'required',
            'qty_digunakan.*' => 'required',
        ]);

        $kode_produksi = $request->input('kode_produksi');
        $tgl_mulai_produksi = date('Y-m-d', strtotime($request->input('tgl_mulai_produksi')));
        $tgl_selesai_produksi = date('Y-m-d', strtotime($request->input('tgl_selesai_produksi')));
        $id_lokasi = $request->input('id_lokasi');
        $catatan = $request->input('catatan');
        $id_produk_arr = $request->input('id_produk');
        $qty_produksi_arr = $request->input('qty_produksi');
        $keterangan_arr = $request->input('keterangan');
        $qty_digunakan_arr = $request->input('qty_digunakan');
        $month = date('m', strtotime($tgl_mulai_produksi));
        $year = date('Y', strtotime($tgl_mulai_produksi));
        $date_modified = date('Y-m-d H:i:s');

        DB::beginTransaction();
        try {
            $data_insert = [
                'kode_produksi' => $kode_produksi,
                'tgl_mulai_produksi' => $tgl_mulai_produksi,
                'tgl_selesai_produksi' => $tgl_selesai_produksi,
                'id_lokasi' => $id_lokasi,
                'catatan' => $catatan,
            ];

            $id_produksi = mProduksi::create($data_insert)->id;

            $data_detail_produksi = [];
            foreach ($id_produk_arr as $key => $id_produk) {
                $qty_produksi = $qty_produksi_arr[$key];
                $keterangan = $keterangan_arr[$key];
                $data_detail_produksi[] = [
                    'id_produksi' => $id_produksi,
                    'id_produk' => $id_produk,
                    'month' => $month,
                    'year' => $year,
                    'qty' => $qty_produksi,
                    'keterangan' => $keterangan,
                    'created_at' => $date_modified,
                    'updated_at' => $date_modified,
                ];
            }

            mDetailProduksi::insert($data_detail_produksi);

            $data_bahan_produksi = [];
            foreach ($qty_digunakan_arr as $key => $id_stok_bahan_arr) {
                foreach ($id_stok_bahan_arr as $id_stok_bahan => $qty_digunakan) {
                    $id_bahan = mStokBahan::where('id', $id_stok_bahan)->value('id_bahan');
                    $id_bahan = $id_bahan ? $id_bahan : 0;

                    $id_satuan = mBahan::where('id', $id_bahan)->value('id_satuan');
                    $id_satuan = $id_satuan ? $id_satuan : 0;

                    $id_lokasi = mStokBahan::where('id', $id_stok_bahan)->value('id_lokasi');
                    if ($id_lokasi) {
                        $lokasi = mLokasi::where('id', $id_lokasi)->first();
                        $gudang_qty = $lokasi['lokasi'];
                    } else {
                        $gudang_qty = '';
                    }

                    $qty = mStokBahan::where('id', $id_stok_bahan)->value('qty');
                    $qty = $qty ? $qty : 0;

                    $data_bahan_produksi[] = [
                        'id_produksi' => $id_produksi,
                        'id_bahan' => $id_bahan,
                        'id_satuan' => $id_satuan,
                        'qty_diperlukan' => $qty_digunakan,
                        'gudang_qty' => $gudang_qty,
                        'qty' => $qty,
                        'created_at' => $date_modified,
                        'updated_at' => $date_modified,
                    ];
                }
            }

            mBahanProduksi::insert($data_bahan_produksi);

            DB::commit();
        } catch (\Throwable $exception) {
            throw $exception;

            DB::rollBack();
        }

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

    function bahan_list(Request $request)
    {
        $id_produk = $request->input('id_produk');
        $qty_produksi = $request->input('qty_produksi');

        $komposisi_produk = mKomposisiProduk::select([
            'tb_bahan.*',
            'tb_komposisi_produk.*',
            'tb_komposisi_produk.qty AS komposisi_qty'
        ])
            ->leftJoin('tb_bahan', 'tb_bahan.id', '=', 'tb_komposisi_produk.id_bahan')
            ->where('tb_komposisi_produk.id_produk', $id_produk)
            ->orderBy('nama_bahan', 'ASC')
            ->get();

        $data = [
            'qty_produksi' => $qty_produksi,
            'komposisi_produk' => $komposisi_produk
        ];

        return view('produksi.produksiBahanList', $data);
    }
}
