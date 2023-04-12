<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateMahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Misal Kita update data mahasiswa yang ada saat ini milik TI 2A
        DB::table('mahasiswas')->update(['kelas_id' => 1]);
    }
}
