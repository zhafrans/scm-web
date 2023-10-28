<?php

namespace Database\Seeders;

use App\Models\Petugas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Data untuk satu entri dalam tabel "petugas"
         $data = [
            'username' => 'zhafran',
            'password' => Hash::make('123456'),
            'hak_akses' => 'admin',
            'jenis' => 'Administrator',
            'bagian' => 'Keuangan',
            // Tambahkan kolom lain sesuai dengan struktur tabel Anda
        ];

        // Masukkan data ke dalam database
        Petugas::create($data);
    }
}
