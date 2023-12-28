<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function pengumuman()
    {
        return view('dashboard.pengumuman.pengumuman');
    }

    public function createPengumuman()
    {
        return view('dashboard.pengumuman.admin.buat-pengumuman');
    }

    public function storePengumuman(Request $request)
    {
        $request->validate([
            'judul_pengumuman' => 'required',
            'isi_pengumuman' => 'required',
            'tanggal_awal_pengumuman' => 'required',
            'tanggal_akhir_pengumuman' => 'required',
        ]);

        $pengumuman = new Pengumuman();
        $pengumuman->judul_pengumuman = $request->judul_pengumuman;
        $pengumuman->isi_pengumuman = $request->isi_pengumuman;
        $pengumuman->tanggal_awal_pengumuman = $request->tanggal_awal_pengumuman;
        $pengumuman->tanggal_akhir_pengumuman = $request->tanggal_akhir_pengumuman;
        $pengumuman->akun_pembuat_pengumuman = auth()->user()->email;
        $pengumuman->save();

        return redirect()->route('pengumuman')->with([
            'pengumuman_success' => true,
            'message' => 'Pengumuman berhasil dibuat!'
        ]);
    }

    public function editPengumuman($id)
    {
        $pengumuman = Pengumuman::find($id);
        return view('dashboard.pengumuman.admin.edit-pengumuman', compact(['pengumuman']));
    }

    public function updatePengumuman(Request $request)
    {
        $request->validate([
            'judul_pengumuman' => 'required',
            'isi_pengumuman' => 'required',
            'tanggal_awal_pengumuman' => 'required',
            'tanggal_akhir_pengumuman' => 'required',
        ]);

        $pengumuman = Pengumuman::find($request->id);
        $pengumuman->judul_pengumuman = $request->judul_pengumuman;
        $pengumuman->isi_pengumuman = $request->isi_pengumuman;
        $pengumuman->tanggal_awal_pengumuman = $request->tanggal_awal_pengumuman;
        $pengumuman->tanggal_akhir_pengumuman = $request->tanggal_akhir_pengumuman;
        $pengumuman->save();

        return redirect()->route('pengumuman')->with([
            'pengumuman_success' => true,
            'message' => 'Pengumuman berhasil diupdate!'
        ]);
    }

    public function deletePengumuman(Request $request)
    {
        $pengumuman = Pengumuman::find($request->id);
        $pengumuman->delete();

        return redirect()->route('pengumuman')->with([
            'pengumuman_success' => true,
            'message' => 'Pengumuman berhasil dihapus!'
        ]);
    }
}
