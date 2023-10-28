<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;


class ListProdukController extends Controller
{  

    public function listProduk($jenis_barang_id){
        $product = Barang::leftJoin('harga_barang', function($join) {
            $join->on('harga_barang.id_barang', '=', 'barang.id')
                 ->on('harga_barang.tanggal', '=', DB::raw('(SELECT MAX(tanggal) FROM harga_barang WHERE id_barang = barang.id)'));
        })
        ->leftJoin('jenis_barang', 'jenis_barang.id', '=', 'barang.id_jenis')
        ->select('barang.id', 'barang.nama', 'harga_barang.harga')
        ->where('jenis_barang.id', $jenis_barang_id)
        ->orderBy('barang.id', 'asc')
        ->get();

        if ($product) {
            return response()->json($product);
        } else {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }
    }

    //     public function getProdukById($id)
    // {
    //     $product = Barang::leftJoin('harga_barang', function ($join) {
    //         $join->on('harga_barang.id_barang', '=', 'barang.id')
    //             ->on('harga_barang.tanggal', '=', DB::raw('(SELECT MAX(tanggal) FROM harga_barang WHERE id_barang = barang.id)'));
    //     })
    //         ->leftJoin('jenis_barang', 'jenis_barang.id', '=', 'barang.id_jenis')
    //         ->where('barang.id', $id)
    //         ->orderBy('barang.id', 'asc')
    //         ->get();

    //     $barang = Barang::leftJoin('harga_barang', 'harga_barang.id_barang', '=', 'barang.id')
    //         ->whereColumn('harga_barang.id_jenis_outlet', 'outlet.id_jenis')
    //         ->leftJoin('outlet', 'outlet.id_jenis', '=', 'harga_barang.id_jenis_outlet')
    //         ->leftJoin('jenis_barang', 'jenis_barang.id', '=', 'barang.id_jenis')
    //         ->where('harga_barang.id_jenis_outlet', $id)
    //         ->orderByDesc('harga_barang.tanggal')
    //         ->first();

    //     if ($product->isEmpty() && !$barang) {
    //         return response()->json(['message' => 'Produk tidak ditemukan'], 404);
    //     }

    //     $result = [];

    //     if (!$product->isEmpty()) {
    //         $result['product'] = $product->map(function ($item) {
    //             return [
    //                 'id' => $item->id,
    //                 'nama' => $item->nama,
    //                 'harga' => $item->harga,
    //             ];
    //         });
    //     }

    //     if ($barang) {
    //         $stok = DB::table('detail_barang')
    //             ->selectRaw('count(id_barang) as qty')
    //             ->where('id_barang', $barang->id)
    //             ->first();

    //         $result['barang'] = [
    //             'id' => $barang->id,
    //             'nama' => $barang->nama,
    //             'harga' => $barang->harga,
    //             'deskripsi' => $barang->keterangan,
    //             'stok' => $stok->qty,
    //         ];
    //     }

    //     return response()->json($result, 200);
    // }
}
