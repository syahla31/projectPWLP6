<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa_MataKuliah extends Model
{
    protected $table="mahasiswa_matakuliah";
    public $timestamps= false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'mahasiswa_id',
        'matkul_id',
        'nilai',
    ];

    public function matakuliah(){
        return $this->belongsTo(MataKuliah::class);
    }
}
