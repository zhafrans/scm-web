<?php

namespace App\Imports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\ToModel;

class BarangImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Barang([
            'nama'     => $row[1],
            'id_jenis'    => $row[2],
            'keterangan' => $row[3],
            'fisik'    => $row[4],
        ]);
    }
}
