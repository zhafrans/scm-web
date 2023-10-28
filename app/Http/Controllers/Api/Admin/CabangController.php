<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cabang;
use App\Models\Cluster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CabangController extends Controller
{
    // public function index() // testing 1 tanpa join
    // {
    //     $data = Cabang::orderBy('id_cluster', 'asc')->get();
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Data Cabang Ditemukan',
    //         'data' => $data
    //     ], 200);
        
    // }

//     public function index() //testing 2
// {
//     $data = Cabang::join('cluster', 'cluster.id', '=', 'cabang.id_cluster')
//         ->select('cabang.*', 'cluster.nama as cluster_nama')
//         ->orderBy('cabang.id_cluster', 'asc')
//         ->get();

//     return response()->json([
//         'status' => true,
//         'message' => 'Data Cabang Ditemukan dengan Informasi Cluster',
//         'data' => $data
//     ], 200);
// }

public function index()
{
    $data = Cabang::leftJoin('cluster', 'cluster.id', '=', 'cabang.id_cluster')
        ->select('cabang.id', 'cabang.nama', 'cabang.alamat', 'cluster.nama as nama_cluster')
        ->orderBy('cabang.id', 'asc')
        ->get();

    return response()->json([
        'status' => true,
        'message' => 'Data Cabang Ditemukan dengan Informasi Cluster',
        'data' => $data
    ], 200);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $lastcluster = Cluster::latest()->first();
        // if ($lastcluster) {
        // $clusterId = $lastcluster->id;
        // } else {
        //     return "";
        // }

        $dataCabang = new Cabang;

        $rules = [
            'nama' => 'required',
            'alamat' => 'required',
            'id_cluster' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memasukkan data Cabang',
                'data' => $validator->errors()
            ]);
        }

        $dataCabang->nama = $request->nama;
        $dataCabang->alamat = $request->alamat;
        $dataCabang->id_cluster = $request->id_cluster;
        

        $post = $dataCabang->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses memasukkan data Cabang'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // jika ingin BY id ganti dengan $id
    {
        $data = Cabang::leftJoin('cluster', 'cluster.id', '=', 'cabang.id_cluster')
        ->select('cabang.id', 'cabang.nama', 'cabang.alamat', 'cluster.nama as nama_cluster')
        ->orderBy('cabang.id', 'asc')
        ->find($id); // BY ID

        // $data = Cabang::leftJoin('cluster', 'cluster.id', '=', 'cabang.id_cluster')
        // ->select('cabang.id', 'cabang.nama', 'cabang.alamat', 'cluster.nama as nama_cluster')
        // ->where('cabang.nama', $namaCabang)
        // ->first(); // BY NAMA

        if($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data Cabang ditemukan',
                'data' => $data
            ], 200);
        } else{
            return response()->json([
                'status' => false,
                'message' => 'Data Cabang tidak ditemukan'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $dataCabang = Cabang::leftJoin('cluster', 'cluster.id', '=', 'cabang.id_cluster')
        ->select('cabang.id', 'cabang.nama', 'cabang.alamat', 'cluster.nama as nama_cluster')
        ->orderBy('cabang.id', 'asc')
        ->find($id);

        if(empty($dataCabang)){
            return response()->json([
                'status' => false,
                'message' => 'Data Cabang tidak ditemukan'
            ], 404);
        }

        $rules = [
            // 'nama' => 'required',
            // 'alamat' => 'required',
            // 'alamat' => 'required',

        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal melakukan UPDATE data Cabang',
                'data' => $validator->errors()
            ]);
        }

        $dataCabang->nama = $request->nama;
        $dataCabang->alamat = $request->alamat;
        $dataCabang->id_cluster = $request->id_cluster;
        // $dataCabang->id_cluster = $clusterId;

        $post = $dataCabang->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan UPDATE data Cabang'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataCabang = Cabang::find($id);

        if(empty($dataCabang)){
            return response()->json([
                'status' => false,
                'message' => 'Data Cabang tidak ditemukan'
            ], 404);
        }

        $post = $dataCabang->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan DELETE data Cabang'
        ]);
    }
}
