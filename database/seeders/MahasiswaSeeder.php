<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'Nim' => 2141720015,
                'Nama' => 'Syahla Syafiqah Fayra',
                'Kelas' => 'TI - 2F',
                'Jurusan' => 'Teknologi Informasi',
                'No_Handphone' => '081381776064'
            ],
            [
                'Nim' => 2141720016,
                'Nama' => 'Zahra Annisa Wahono',
                'Kelas' => 'TI - 2F',
                'Jurusan' => 'Teknologi Informasi',
                'No_Handphone' => '081238509815'
            ],
            [
                'Nim' => 2141720250,
                'Nama' => 'RR Denti Nurromadhona',
                'Kelas' => 'TI - 2F',
                'Jurusan' => 'Teknologi Informasi',
                'No_Handphone' => '082133081073'
            ],
        ];
        DB::table('mahasiswas')->insert($data);
    }
}