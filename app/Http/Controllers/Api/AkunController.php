<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\ApiFormater;
use App\Models\Akun;
use App\Models\Pekerjaan;
use App\Models\Profil;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function insertData(Request $request)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'id_akun' => 'required|unique:akun',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // Insert data ke tabel 'akun'
        $akun = Akun::create([
            'id_akun' => $request->id_akun,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        // Insert data ke tabel 'profil'
        $profil = Profil::create([
            'id_akun' => $request->id_akun,
            'nama_akun' => $request->nama_akun,
            'umur' => $request->umur,
            'kode_otp' => $request->kode_otp,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nomer_hp' => $request->nomer_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'your_interested' => $request->your_interested,
            'gambar_profile' => $request->gambar_profile,
        ]);
        // Insert data ke tabel 'pekerjaan'
        $pekerjaan = Pekerjaan::create([
            'id_akun' => $request->id_akun,
            'lokasi' => $request->lokasi,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'pekerjaan' => $request->pekerjaan,
        ]);
        // Berikan respon berhasil
        return response()->json(['message' => 'Data berhasil ditambahkan'], 201);
    }
    public function updateData(Request $request, $id_akun)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // Cari data akun yang akan diupdate
        $akun = Akun::find($id_akun);
        // Jika data akun tidak ditemukan, berikan respon error
        if (!$akun) {
            return response()->json(['message' => 'Akun tidak ditemukan'], 404);
        }
        // Update data akun
        $akun->email = $request->email;
        $akun->password = $request->password;
        $akun->save();
        // Cari data profil yang sesuai dengan id_akun
        $profil = Profil::where('id_akun', $id_akun)->first();
        // Jika data profil tidak ditemukan, berikan respon error
        if (!$profil) {
            return response()->json(['message' => 'Profil tidak ditemukan'], 404);
        }
        // Update data profil
        $profil->nama_akun = $request->nama_akun;
        $profil->umur = $request->umur;
        $profil->kode_otp = $request->kode_otp;
        $profil->tanggal_lahir = $request->tanggal_lahir;
        $profil->nomer_hp = $request->nomer_hp;
        $profil->jenis_kelamin = $request->jenis_kelamin;
        $profil->your_interested = $request->your_interested;
        $profil->gambar_profile = $request->gambar_profile;
        $profil->save();
        // Cari data pekerjaan yang sesuai dengan id_akun
        $pekerjaan = Pekerjaan::where('id_akun', $id_akun)->first();
        // Jika data pekerjaan tidak ditemukan, berikan respon error
        if (!$pekerjaan) {
            return response()->json(['message' => 'Pekerjaan tidak ditemukan'], 404);
        }
        // Update data pekerjaan
        $pekerjaan->lokasi = $request->lokasi;
        $pekerjaan->deskripsi_singkat = $request->deskripsi_singkat;
        $pekerjaan->pekerjaan = $request->pekerjaan;
        $pekerjaan->save();
        // Berikan respon berhasil
        return response()->json(['message' => 'Data berhasil diupdate'], 200);
    }

    public function getData($id_akun)
    {
        // Cari data akun berdasarkan id_akun
        $akun = Akun::find($id_akun);
        // Jika data akun tidak ditemukan, berikan respon error
        if (!$akun) {
            return response()->json(['message' => 'Akun tidak ditemukan'], 404);
        }
        // Cari data profil yang sesuai dengan id_akun
        $profil = Profil::where('id_akun', $id_akun)->first();
        // Jika data profil tidak ditemukan, berikan respon error
        if (!$profil) {
            return response()->json(['message' => 'Profil tidak ditemukan'], 404);
        }
        // Cari data pekerjaan yang sesuai dengan id_akun
        $pekerjaan = Pekerjaan::where('id_akun', $id_akun)->first();
        // Jika data pekerjaan tidak ditemukan, berikan respon error
        if (!$pekerjaan) {
            return response()->json(['message' => 'Pekerjaan tidak ditemukan'], 404);
        }
        // Format data yang akan dikirimkan sebagai response
        $data = [
            'id_akun' => $akun->id_akun,
            'email' => $akun->email,
            'password' => $akun->password,
            'nama_akun' => $profil->nama_akun,
            'umur' => $profil->umur,
            'kode_otp' => $profil->kode_otp,
            'tanggal_lahir' => $profil->tanggal_lahir,
            'nomer_hp' => $profil->nomer_hp,
            'jenis_kelamin' => $profil->jenis_kelamin,
            'your_interested' => $profil->your_interested,
            'gambar_profile' => $profil->gambar_profile,
            'lokasi' => $pekerjaan->lokasi,
            'deskripsi_singkat' => $pekerjaan->deskripsi_singkat,
            'pekerjaan' => $pekerjaan->pekerjaan,
        ];
        // Berikan respon dengan data yang ditemukan
        $status =['pesan' => 'Akun Ditemukan', 'data' => $data];
        return response()->json($status, 404);
    }
}