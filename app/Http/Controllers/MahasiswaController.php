<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\Mahasiswa_MataKuliah;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth;
use Ramsey\Collection\Map\AssociativeArrayMap;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$user = Auth::user();
        //fungsi eloquent menampilkan data menggunakan pagination
        $mahasiswas = Mahasiswa::paginate(5); // Mengambil 5 isi tabel
        return view('mahasiswas.index', compact('mahasiswas'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all(); // Mendapatkan data dari tabel
        return view('mahasiswas.create', ['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('image')){
            $image_name = $request->file('image')->store('images', 'public');
        }
        // Melakukan Validasi Data
            $request->validate([
                'Nim' => 'required',
                'Nama' => 'required',
                'kelas' => 'required',
                'Jurusan' => 'required',
                'No_Handphone' => 'required',
                'Email' => 'required',
                'Tanggal_lahir' => 'required',
            ]);

        // Fungsi eloquent untuk menambah data
            $mahasiswa = new Mahasiswa;
            $mahasiswa->Nim=$request->get('Nim');
            $mahasiswa->Nama=$request->get('Nama');
            $mahasiswa->Foto=$image_name;
            $mahasiswa->Jurusan=$request->get('Jurusan');
            $mahasiswa->No_Handphone=$request->get('No_Handphone');
            $mahasiswa->Email=$request->get('Email');
            $mahasiswa->Tanggal_lahir=$request->get('Tanggal_lahir');

        // Fungsi eloquent untuk mmenambah data dengan relasi belongs to
            $kelas = new Kelas;
            $kelas->id = $request->get('kelas');

            $mahasiswa->kelas()->associate($kelas);
            $mahasiswa->save();

        // Jika data berhasil ditambahkan, akan kembali ke halaman utama
            return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    public function show($Nim)
    {
        // Menampilkan detail data dengan menemukan / berdasarkan Nim Mahasiswa
        $Mahasiswa = Mahasiswa::find($Nim);
        return view('mahasiswas.detail', compact('Mahasiswa'));
    }

    public function edit($Nim)
    {
        $kelas = Kelas::all();
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = Mahasiswa::find($Nim);
        return view('mahasiswas.edit', ['kelas' => $kelas], compact('Mahasiswa'));
    }

    public function update(Request $request, $Nim)
    {
        // Melakukan Validasi Data
            $request->validate([
                'Nim' => 'required',
                'Nama' => 'required',
                'kelas' => 'required',
                'Jurusan' => 'required',
                'No_Handphone' => 'required',
                'Email' => 'required',
                'Tanggal_lahir' => 'required',
            ]);
        
        //fungsi eloquent untuk mengupdate data inputan kita
            $mahasiswa = Mahasiswa::with('kelas')->where('Nim', $Nim)->first();

            if ($mahasiswa->Foto && file_exists(storage_path('app/public/' .$mahasiswa->Foto))) {
                Storage::delete('public/' .$mahasiswa->Foto);
            }
            $image_name = $request->file('image')->store('images', 'public');

            $mahasiswa->Nim=$request->get('Nim');
            $mahasiswa->Nama=$request->get('Nama');
            $mahasiswa->Foto=$image_name;
            $mahasiswa->Jurusan=$request->get('Jurusan');
            $mahasiswa->No_Handphone=$request->get('No_Handphone');
            $mahasiswa->Email=$request->get('Email');
            $mahasiswa->Tanggal_lahir=$request->get('Tanggal_lahir');

            $kelas = new Kelas;
            $kelas->id = $request->get('kelas');

        // Fungsi eloquent untuk mengedit data dengan relasi belongs to
            $mahasiswa->kelas()->associate($kelas);
            $mahasiswa->save();

        //jika data berhasil diupdate, akan kembali ke halaman utama
            return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    public function destroy($Nim)
    {
        // Fungsi eloquent untuk menghapus data
            Mahasiswa::find($Nim)->delete();
            return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil Dihapus');
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $mahasiswas = Mahasiswa::where('Nama', 'like', "%" . $keyword . "%")->paginate(5);
        return view('mahasiswas.index', compact('mahasiswas'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function nilai($Nim)
    {
        $Mahasiswa = Mahasiswa::find($Nim);
        $Matakuliah = Matakuliah::all();
        $Mahasiswa_MataKuliah = Mahasiswa_MataKuliah::where('mahasiswa_id','=',$Nim)->get();
        return view('mahasiswas.nilai',['Mahasiswa' => $Mahasiswa],['MahasiswaMataKuliah' => $Mahasiswa_MataKuliah], compact('Mahasiswa_MataKuliah'));
    }

    public function cetak_pdf($Nim){
        $Mahasiswa = Mahasiswa::find($Nim);
        $Matakuliah = Matakuliah::all();
        $MahasiswaMataKuliah = Mahasiswa_MataKuliah::where('mahasiswa_id','=',$Nim)->get();
        $pdf = PDF::loadview('mahasiswas.nilai_pdf', compact('Mahasiswa','MahasiswaMataKuliah'));
        return $pdf->stream();
    }
}
