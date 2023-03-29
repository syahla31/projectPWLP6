<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewMahasiswaSeeder extends Seeder
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
                'Nim' => 2141720047,
                'Nama' => 'Yasmine Navisha Andhani',
                'Kelas' => 'TI - 2F',
                'Jurusan' => 'Teknologi Informasi',
                'No_Handphone' => '081233672068',
                'Email' => '2141720047@student.polinema.ac.id',
                'Tanggal_lahir' => '01 Juni 2003'
            ],
            [
                'Nim' => 2141720241,
                'Nama' => 'Yuliyana Rahmawati',
                'Kelas' => 'TI - 2F',
                'Jurusan' => 'Teknologi Informasi',
                'No_Handphone' => '081238509815',
                'Email' => '2141720047@student.polinema.ac.id',
                'Tanggal_lahir' => '20 Juli 2002'
            ],
            [
                'Nim' => 2141720056,
                'Nama' => 'Jennie Kim',
                'Kelas' => 'TI - 2F',
                'Jurusan' => 'Teknologi Informasi',
                'No_Handphone' => '082112343467',
                'Email' => '2141720047@student.polinema.ac.id',
                'Tanggal_lahir' => '16 Januari 1996'
            ],
            [
                'Nim' => 2141720288,
                'Nama' => 'Lalisa Manoban',
                'Kelas' => 'TI - 2F',
                'Jurusan' => 'Teknologi Informasi',
                'No_Handphone' => '081238507654',
                'Email' => '2141720047@student.polinema.ac.id',
                'Tanggal_lahir' => '27 Maret 1997'
            ],
            [
                'Nim' => 2141720004,
                'Nama' => 'Kim Jisoo',
                'Kelas' => 'TI - 2F',
                'Jurusan' => 'Teknologi Informasi',
                'No_Handphone' => '082112341234',
                'Email' => '2141720047@student.polinema.ac.id',
                'Tanggal_lahir' => '03 Januari 1995'
            ],
            [
                'Nim' => 2141720009,
                'Nama' => 'Park Chae Young',
                'Kelas' => 'TI - 2F',
                'Jurusan' => 'Teknologi Informasi',
                'No_Handphone' => '081342392431',
                'Email' => '2141720047@student.polinema.ac.id',
                'Tanggal_lahir' => '11 Februari 1997'
            ],
        ];
        DB::table('mahasiswas')->insert($data);
    }
}
