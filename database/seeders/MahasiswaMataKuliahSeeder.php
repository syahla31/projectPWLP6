<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaMataKuliahSeeder extends Seeder
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
                'mahasiswa_id' => '2141720004',
                'matakuliah_id' => 1,
                'nilai' => 'B+'
            ],
            [
                'mahasiswa_id' => '2141720016',
                'matakuliah_id' => 2,
                'nilai' => 'A'
            ],
            [
                'mahasiswa_nim' => '2141720047',
                'matakuliah_id' => 3,
                'nilai' => 'A'
            ],
            [
                'mahasiswa_nim' => '2141720288',
                'matakuliah_id' => 4,
                'nilai' => 'A'
            ],
        ];
        DB::table('mahasiswa_matakuliah')->insert($data);
    }
}
