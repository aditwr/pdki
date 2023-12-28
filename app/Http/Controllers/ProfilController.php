<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function profil()
    {
        return view('dashboard.profil.profil');
    }
    public function edit()
    {
        // data to repopulate the form
        $user = auth()->user();
        return view('dashboard.profil.edit-profil', compact(['user']));
    }
    public function update(Request $request)
    {
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg|max:2048',
            'nama_lengkap' => 'required',
            'nomor_telepon' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'pekerjaan_atau_jabatan' => 'required',
            'perusahaan' => 'required',
            'bio' => 'required',
            'alamat' => 'required',
        ]);

        // save image to storage/app/public/avatar;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar')->store('avatar', 'public');
        }

        // store data
        $user = auth()->user();
        $user->name = $request->nama_lengkap;
        if ($request->hasFile('avatar')) {
            $user->avatar = $avatar;
        };
        $user->gender = $request->jenis_kelamin;
        $user->birth_date = $request->tanggal_lahir;
        $user->phone = $request->nomor_telepon;
        $user->job = $request->pekerjaan_atau_jabatan;
        $user->company = $request->perusahaan;
        $user->bio = $request->bio;
        $user->address = $request->alamat;
        $user->save();

        return redirect()->route('profil')->with([
            'update_profile_success' => true,
            'message' => 'Profil berhasil diperbarui',
        ]);
    }
}
