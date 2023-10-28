<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Depo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepoController extends Controller
{
    public function index()
{
    $data = Depo::leftJoin('cluster', 'cluster.id', '=', 'depo.id_cluster')
        ->select('depo.id', 'depo.nama', 'depo.alamat', 'cluster.nama as nama_cluster')
        ->orderBy('depo.id', 'asc')
        ->get();

    return response()->json([
        'status' => true,
        'message' => 'Data Depo Ditemukan dengan Informasi cluster',
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

        // $lastcluster = cluster::latest()->first();
        // if ($lastcluster) {
        // $clusterId = $lastcluster->id;
        // } else {
        //     return "";
        // }

        $datadepo = new Depo;

        $rules = [
            'nama' => 'required',
            'alamat' => 'required',
            'id_cluster' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memasukkan data Depo',
                'data' => $validator->errors()
            ]);
        }

        $datadepo->nama = $request->nama;
        $datadepo->alamat = $request->alamat;
        $datadepo->id_cluster = $request->id_cluster;
        

        $post = $datadepo->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses memasukkan data Depo'
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
        $data = Depo::leftJoin('cluster', 'cluster.id', '=', 'depo.id_cluster')
        ->select('depo.id', 'depo.nama', 'depo.alamat', 'cluster.nama as nama_cluster')
        ->orderBy('depo.id', 'asc')
        ->find($id); // BY ID

        // $data = Depo::leftJoin('cluster', 'cluster.id', '=', 'depo.id_cluster')
        // ->select('depo.id', 'depo.nama', 'depo.alamat', 'cluster.nama as nama_cluster')
        // ->where('depo.nama', $namadepo)
        // ->first(); // BY NAMA

        if($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data Depo ditemukan',
                'data' => $data
            ], 200);
        } else{
            return response()->json([
                'status' => false,
                'message' => 'Data Depo tidak ditemukan'
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

        $datadepo = Depo::leftJoin('cluster', 'cluster.id', '=', 'depo.id_cluster')
        ->select('depo.id', 'depo.nama', 'depo.alamat', 'cluster.nama as nama_cluster')
        ->orderBy('depo.id', 'asc')
        ->find($id);

        if(empty($datadepo)){
            return response()->json([
                'status' => false,
                'message' => 'Data Depo tidak ditemukan'
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
                'message' => 'Gagal melakukan UPDATE data Depo',
                'data' => $validator->errors()
            ]);
        }

        $datadepo->nama = $request->nama;
        $datadepo->alamat = $request->alamat;
        $datadepo->id_cluster = $request->id_cluster;
        // $datadepo->id_cluster = $clusterId;

        $post = $datadepo->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan UPDATE data Depo'
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
        $datadepo = Depo::find($id);

        if(empty($datadepo)){
            return response()->json([
                'status' => false,
                'message' => 'Data Depo tidak ditemukan'
            ], 404);
        }

        $post = $datadepo->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan DELETE data Depo'
        ]);
    }
}
