<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ListProduk;
use Illuminate\Http\Request;
use App\Models\Barang;

class DetailProdukController extends Controller
{
    public function getProdukByJenisBarang($jenis_barang_nama){
        $product = Barang::leftJoin('harga_barang', function($join) {
            $join->on('harga_barang.id_barang', '=', 'barang.id')
                 ->on('harga_barang.tanggal', '=', DB::raw('(SELECT MAX(tanggal) FROM harga_barang WHERE id_barang = barang.id)'));
        })
        ->leftJoin('outlet', 'outlet.id_jenis', '=', 'harga_barang.id_jenis_outlet')
        ->leftJoin('jenis_barang', 'jenis_barang.id', '=', 'barang.id_jenis')
        ->select('barang.id', 'barang.nama', 'harga_barang.harga', 'barang.keterangan')
        ->where('jenis_barang.nama', $jenis_barang_nama)
        ->orderBy('barang.id', 'asc')
        ->get();

        if ($product->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Barang tidak ditemukan',
            ], 404);
        }

        $result = [];

        foreach ($product as $barang) {
            $stok = DB::table('detail_barang')
                ->selectRaw('count(id_barang) as qty')
                ->where('id_barang', $barang->id)
                ->first();

            $result[] = [
                'id' => $barang->id,
                'nama' => $barang->nama,
                'harga' => $barang->harga,
                'deskripsi' => $barang->keterangan,
                'stok' => $stok->qty,
            ];
        }

        return response()->json([
            'status' => true,
            'message' => 'Data Barang Ditemukan',
            'data' => $result,
        ], 200);
    }
    // public function getProdukByOutlet()//$id_outlet
    // {
    //     $barang = Barang::leftJoin('harga_barang', 'harga_barang.id_barang', '=', 'barang.id')
    //         ->whereColumn('harga_barang.id_jenis_outlet', 'outlet.id_jenis')
    //         ->leftJoin('outlet', 'outlet.id_jenis', '=', 'harga_barang.id_jenis_outlet')
    //         ->leftJoin('jenis_barang', 'jenis_barang.id', '=', 'barang.id_jenis')
    //         ->select('barang.id', 'barang.nama', 'harga_barang.harga', 'barang.keterangan')
    //         //->where('harga_barang.id_barang', $id_barang)
    //         //->where('harga_barang.id_jenis_outlet', $id_outlet)
    //         ->orderByDesc('harga_barang.tanggal')
    //         ->first();

    //     if (!$barang) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Barang tidak ditemukan',
    //         ], 404);
    //     }

    //     $stok = DB::table('detail_barang')
    //         ->selectRaw('count(id_barang) as qty')
    //         ->where('id_barang', $barang->id)
    //         ->first();

    //     if ($stok->qty > 0) {
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Data Barang Ditemukan',
    //             'data' => [
    //                 'id' => $barang->id,
    //                 'nama' => $barang->nama,
    //                 'harga' => $barang->harga, //mengelompokan pada list produk agar sesuai jenis seperti voucher dll
    //                 'deskripsi' => $barang->keterangan,                
    //                 'stok' => $stok->qty,
    //             ],
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Stok barang habis',
    //             'data' => [
    //                 'id' => $barang->id,
    //                 'nama' => $barang->nama,
    //                 'harga' => $barang->harga,
    //                 'deskripsi' => $barang->keterangan,
    //                 'stok' => $stok->qty,
    //             ],
    //         ], 404);
    //     }
    // }

    // public function getProdukByJenisBarang($jenis_barang_id)
    // {
    //     $barangs = Barang::leftJoin('harga_barang', 'harga_barang.id_barang', '=', 'barang.id')
    //         ->leftJoin('outlet', 'outlet.id_jenis', '=', 'harga_barang.id_jenis_outlet')
    //         ->leftJoin('jenis_barang', 'jenis_barang.id', '=', 'barang.id_jenis')
    //         ->select('barang.id', 'barang.nama', 'harga_barang.harga', 'barang.keterangan')
    //         //->where('harga_barang.id_jenis_outlet', $id_outlet)
    //         ->where('jenis_barang.id', $jenis_barang_id)
    //         ->orderByDesc('harga_barang.tanggal')
    //         ->get();

    //     if ($barangs->isEmpty()) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Barang tidak ditemukan',
    //         ], 404);
    //     }

    //     $result = [];

    //     foreach ($barangs as $barang) {
    //         $stok = DB::table('detail_barang')
    //             ->selectRaw('count(id_barang) as qty')
    //             ->where('id_barang', $barang->id)
    //             ->first();

    //         $result[] = [
    //             'id' => $barang->id,
    //             'nama' => $barang->nama,
    //             'harga' => $barang->harga,
    //             'deskripsi' => $barang->keterangan,
    //             'stok' => $stok->qty,
    //         ];
    //     }

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Data Barang Ditemukan',
    //         'data' => $result,
    //     ], 200);
    // }

}
