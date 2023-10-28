<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailProdukMobile;
use App\Models\TransaksiMobile;
use App\Models\TransaksiMobileDetail;
use Illuminate\Support\Facades\Validator;

class TransaksiMobileController extends Controller
{    
    public function insertTransaksi(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'id_cabang' => 'required',
            'id_outlet' => 'required',
            'tanggal' => 'required',
            'tipe_payment' => 'required',
            'total' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Set nilai "status" ke "proses" secara otomatis
        $data['status'] = 'proses';

        // Simpan data transaksi ke tabel m_transaksi
        $transaksi = TransaksiMobile::create($data);

        // Jika transaksi berhasil disimpan, kita juga akan menyimpan data detail produk
        if ($transaksi) {
            DetailProdukMobile::create([
                'id_transaksi' => $transaksi->id, // pake id transaksi dari tabel m_transaksi
                'id_barang' => $request->input('id_barang'),
                'jumlah' => $request->input('jumlah'),
                'harga_jual' => $request->input('harga_jual'),
                'status' => 'proses' // Set nilai "status" ke "proses" secara otomatis
            ]);

            return response()->json(['message' => 'Transaksi berhasil disimpan'], 201);
        } else {
            return response()->json(['message' => 'Transaksi gagal disimpan'], 500);
        }
    }


    //post
    ////status dikirim langsung  otomatis proses
    // public function insertTransaksi(Request $request)
    // {
    //     $data = $request->all();

    //     $validator = Validator::make($data, [
    //         'id_cabang' => 'required',
    //         'id_outlet' => 'required',
    //         'tanggal' => 'required',
    //         'tipe_payment' => 'required',
    //         'total' => 'required',
    //         'status' => 'required'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()], 400);
    //     }

    // // Simpan data transaksi ke tabel m_transaksi
    //     $transaksi = TransaksiMobile::create($data);

    // // Jika transaksi berhasil disimpan, kita juga akan menyimpan data detail produk
    //     if ($transaksi) {

    //             DetailProdukMobile::create([
    //                 'id_transaksi' => $transaksi->id, // pake id transaksi dari tabel m_transaksi
    //                 'id_barang' => $request->input('id_barang'),
    //                 'jumlah' =>$request->input('jumlah'),
    //                 'harga_jual' => $request->input('harga_jual'),
    //                 'status' => $request->input('status')
    //          ]);
        

    //         return response()->json(['message' => 'Transaksi berhasil disimpan'], 201);
    //     } else {
    //         return response()->json(['message' => 'Transaksi gagal disimpan'], 500);
    //     }
    // }
    
    //get
    public function getTransaksiByStatus($status)
    {
        $detailProduk = DB::table('m_detail_produk')
            ->join('m_transaksi', 'm_transaksi.id', '=', 'm_detail_produk.id_transaksi')
            ->select('m_detail_produk.id_transaksi', 'm_detail_produk.id_barang', 'm_detail_produk.jumlah', 'm_detail_produk.harga_jual', 'm_detail_produk.status')
            ->where('m_transaksi.status', $status)
            ->get();
    
        if ($detailProduk->isEmpty()) {
            return response()->json(['message' => 'Data transaksi dengan status ' . $status . ' tidak ditemukan'], 404);
        }
    
        return response()->json(['data' => $detailProduk], 200);
    }

    //Menampilkan detail transaksi berdasarkan tabel m_detail_transaksi
    //buat agar dipanggil by id_m_transaksi bukan by id saja
    public function getTransaksiById($id_m_transaksi)
    {
        $detailTransaksi = TransaksiMobileDetail::where('id_m_transaksi', $id_m_transaksi)->get();
    
        if ($detailTransaksi->isEmpty()) {
            return response()->json(['message' => 'Data transaksi tidak ditemukan'], 404);
        }
    
        return response()->json(['data' => $detailTransaksi], 200);
    }

    //Menampilkan detail dari transaksi sesuai dengan database tabel m_transaksi
    public function getDetailTransaksiById($id_m_transaksi)
    {
        $detailtransaksi = TransaksiMobile::find($id_m_transaksi);
    
        if (!$detailtransaksi) {
            return response()->json(['message' => 'Data transaksi tidak ditemukan'], 404);
        }
    
        return response()->json(['data' => $detailtransaksi], 200);
    }
    
   


}
