<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\PendaftaranMerek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PermohonanController extends Controller
{
    public $perPage = 10;
    public function permohonan()
    {
        // $pendaftaran_mereks = PendaftaranMerek::latest()->paginate($this->perPage);
        $pendaftaran_mereks = PendaftaranMerek::where('akun_pembuat_permohonan', auth()->user()->email)->latest()->paginate($this->perPage);
        $perlu_lengkapi_profil = false;
        // jika profil user yg login ini belum lengkap
        if (auth()->user()->avatar == null || auth()->user()->gender == null || auth()->user()->birth_date == null || auth()->user()->phone == null || auth()->user()->job == null || auth()->user()->company == null || auth()->user()->bio == null || auth()->user()->address == null) {
            $perlu_lengkapi_profil = true;
        }
        return view('dashboard.permohonan.permohonan', compact(['pendaftaran_mereks', 'perlu_lengkapi_profil']));
    }

    public function pendaftaranMerk()
    {
        $country_codes = config('constants.country_code');
        foreach ($country_codes as $key => $value) {
            $countries[] = $value;
        }
        return view('dashboard.permohonan.pendaftaran-merek', compact(['countries']));
    }

    public function storePendaftaranMerk(Request $request)
    {
        // validate request
        $request->validate([
            'nama_merek' => 'required',
            'logo_merek' => 'required',
            'jenis_barang_jasa' => 'required',
            'kelas_barang_jasa' => 'required',
            'pemohon' => 'required',
            'alamat_pemohon' => 'required',
            'no_telepon_pemohon' => 'required',
            'tanda_tangan_pemohon' => 'required',
            'kewarganegaraan_pemohon' => 'required',
        ]);

        // generate nomor permohonan
        $no_permohonan = 'M' . now()->year . now()->month . now()->day . now()->hour . now()->minute . now()->second . auth()->user()->id;

        // move file from tmp to permanent folder
        // logo merek
        if ($request->logo_merek_filename) {
            Storage::copy('tmp/logo_merek/' . $request->logo_merek_tmp_folder . '/' . $request->logo_merek_filename, 'logo_merek/' . $request->logo_merek_filename);
        }
        // delete tmp folder
        Storage::deleteDirectory('tmp/logo_merek/' . $request->logo_merek_tmp_folder);

        // surat keterangan umk
        if ($request->surat_keterangan_umk_filename) {
            Storage::copy('tmp/surat_keterangan_umk/' . $request->surat_keterangan_umk_tmp_folder . '/' . $request->surat_keterangan_umk_filename, 'surat_keterangan_umk/' . $request->surat_keterangan_umk_filename);
        }
        // delete tmp folder
        Storage::deleteDirectory('tmp/surat_keterangan_umk/' . $request->surat_keterangan_umk_tmp_folder);

        // tanda tangan pemohon
        if ($request->tanda_tangan_pemohon_filename) {
            Storage::copy('tmp/tanda_tangan_pemohon/' . $request->tanda_tangan_pemohon_tmp_folder . '/' . $request->tanda_tangan_pemohon_filename, 'tanda_tangan_pemohon/' . $request->tanda_tangan_pemohon_filename);
        }
        // delete tmp folder
        Storage::deleteDirectory('tmp/tanda_tangan_pemohon/' . $request->tanda_tangan_pemohon_tmp_folder);

        // store to database
        $data = $request->all();

        $pendaftaran_merek = PendaftaranMerek::create([
            'no_permohonan' => $no_permohonan,
            'nama_merek' => $data['nama_merek'],
            'logo_merek' => $data['logo_merek_filename'],
            'translasi' => $data['translasi'] ?? null,
            'jenis_barang_jasa' => $data['jenis_barang_jasa'],
            'kelas_barang_jasa' => $data['kelas_barang_jasa'],
            'surat_keterangan_umk' => $data['surat_keterangan_umk_filename'] ? $data['surat_keterangan_umk_filename'] : null,
            'pemohon' => $data['pemohon'],
            'alamat_pemohon' => $data['alamat_pemohon'],
            'no_telepon_pemohon' => $data['no_telepon_pemohon'],
            'tanda_tangan_pemohon' => $data['tanda_tangan_pemohon_filename'],
            'kewarganegaraan_pemohon' => $data['kewarganegaraan_pemohon'],
            'konsultan' => $data['konsultan'] ?? null,
            'alamat_konsultan' => $data['alamat_konsultan'] ?? null,
            'no_telepon_konsultan' => $data['no_telepon_konsultan'] ?? null,
            'kewarganegaraan_konsultan' => $data['kewarganegaraan_konsultan'] ?? null,
            'akun_pembuat_permohonan' => auth()->user()->email,
        ]);

        if ($pendaftaran_merek) {
            // create notification
            Notifikasi::create([
                'pendaftaran_merek_id' => $pendaftaran_merek->id,
                'akun_penerima_notifikasi' => auth()->user()->email,
                'judul_notifikasi' => 'Permohoan Pendaftaran Merek ' . $data['nama_merek'] . ' berhasil dibuat!',
                'isi_notifikasi' => 'Permohonan pendaftaran merek ' . $data['nama_merek'] . ' dengan nomor permohonan ' . $no_permohonan . ' telah dibuat. Silahkan tunggu pemeriksaan dari admin.',
                'link_notifikasi' => route('permohonan.pendaftaran-merek.show', $no_permohonan),
                'nomor_pengumuman' => null,
            ]);
        }

        return redirect()->route('permohonan', compact(['pendaftaran_merek']))->with([
            'permohonan_merek_success' => true,
            'link' => route('permohonan.pendaftaran-merek.show', $no_permohonan),
            'no_permohonan' => $no_permohonan,
            'nama_merek' => $data['nama_merek']
        ]);
    }

    public function revisiPendaftaranMerk($no_permohonan)
    {
        $country_codes = config('constants.country_code');
        foreach ($country_codes as $key => $value) {
            $countries[] = $value;
        }
        $pendaftaran_merek = PendaftaranMerek::where('no_permohonan', $no_permohonan)->first();
        return view('dashboard.permohonan.revisi-pendaftaran-merek', compact(['countries', 'pendaftaran_merek']));
    }

    public function updatePendaftaranMerk(Request $request, $no_permohonan)
    {
        // validate request
        $request->validate([
            'nama_merek' => 'required',
            'jenis_barang_jasa' => 'required',
            'kelas_barang_jasa' => 'required',
            'pemohon' => 'required',
            'alamat_pemohon' => 'required',
            'no_telepon_pemohon' => 'required',
            'kewarganegaraan_pemohon' => 'required',
        ]);

        // move file from tmp to permanent folder
        // logo merek
        $logo_merek = json_decode($request->pendaftaran_merek)->logo_merek;
        if ($request->logo_merek_filename != null) {
            Storage::copy('tmp/logo_merek/' . $request->logo_merek_tmp_folder . '/' . $request->logo_merek_filename, 'logo_merek/' . $request->logo_merek_filename);
            $logo_merek = $request->logo_merek_filename;
            // delete tmp folder
            Storage::deleteDirectory('tmp/logo_merek/' . $request->logo_merek_tmp_folder);
            // delete old logo merek
            Storage::delete('logo_merek/' . json_decode($request->pendaftaran_merek)->logo_merek);
        }

        // surat keterangan umk
        $surat_keterangan_umk = json_decode($request->pendaftaran_merek)->surat_keterangan_umk;
        if ($request->surat_keterangan_umk_filename != null) {
            Storage::copy('tmp/surat_keterangan_umk/' . $request->surat_keterangan_umk_tmp_folder . '/' . $request->surat_keterangan_umk_filename, 'surat_keterangan_umk/' . $request->surat_keterangan_umk_filename);
            $surat_keterangan_umk = $request->surat_keterangan_umk_filename;
            // delete tmp folder
            Storage::deleteDirectory('tmp/surat_keterangan_umk/' . $request->surat_keterangan_umk_tmp_folder);
            // delete old surat keterangan umk
            Storage::delete('surat_keterangan_umk/' . json_decode($request->pendaftaran_merek)->surat_keterangan_umk);
        }

        // tanda tangan pemohon
        $tanda_tangan_pemohon = json_decode($request->pendaftaran_merek)->tanda_tangan_pemohon;
        if ($request->tanda_tangan_pemohon_filename != null) {
            Storage::copy('tmp/tanda_tangan_pemohon/' . $request->tanda_tangan_pemohon_tmp_folder . '/' . $request->tanda_tangan_pemohon_filename, 'tanda_tangan_pemohon/' . $request->tanda_tangan_pemohon_filename);
            $tanda_tangan_pemohon = $request->tanda_tangan_pemohon_filename;
            // delete tmp folder
            Storage::deleteDirectory('tmp/tanda_tangan_pemohon/' . $request->tanda_tangan_pemohon_tmp_folder);
            // delete old tanda tangan pemohon
            Storage::delete('tanda_tangan_pemohon/' . json_decode($request->pendaftaran_merek)->tanda_tangan_pemohon);
        }

        $data = $request->all();

        // get pendaftaran merek
        $pendaftaran_merek = PendaftaranMerek::where('no_permohonan', $no_permohonan)->first();
        $pendaftaran_merek->update([
            'nama_merek' => $data['nama_merek'],
            'logo_merek' => $logo_merek,
            'translasi' => $data['translasi'] ?? null,
            'jenis_barang_jasa' => $data['jenis_barang_jasa'],
            'kelas_barang_jasa' => $data['kelas_barang_jasa'],
            'status' => 2,
            'surat_keterangan_umk' => $surat_keterangan_umk,
            'pemohon' => $data['pemohon'],
            'alamat_pemohon' => $data['alamat_pemohon'],
            'no_telepon_pemohon' => $data['no_telepon_pemohon'],
            'tanda_tangan_pemohon' => $tanda_tangan_pemohon,
            'kewarganegaraan_pemohon' => $data['kewarganegaraan_pemohon'],
            'konsultan' => $data['konsultan'] ?? null,
            'alamat_konsultan' => $data['alamat_konsultan'] ?? null,
            'no_telepon_konsultan' => $data['no_telepon_konsultan'] ?? null,
            'kewarganegaraan_konsultan' => $data['kewarganegaraan_konsultan'] ?? null,
            'akun_pembuat_permohonan' => auth()->user()->email,
        ]);
        $pendaftaran_merek->save();


        // create notification
        Notifikasi::create([
            'pendaftaran_merek_id' => $pendaftaran_merek->id,
            'akun_penerima_notifikasi' => auth()->user()->email,
            'judul_notifikasi' => 'Permohoan Pendaftaran Merek' . $data['nama_merek'] . ' berhasil direvisi!',
            'isi_notifikasi' => 'Permohonan pendaftaran merek ' . $data['nama_merek'] . ' dengan nomor permohonan ' . $no_permohonan . ' telah telah selesai direvisi. Silahkan tunggu pemeriksaan dari admin.',
            'link_notifikasi' => route('permohonan.pendaftaran-merek.show', $no_permohonan),
            'nomor_pengumuman' => null,
        ]);


        return redirect()->route('permohonan', compact(['pendaftaran_merek']))->with([
            'revisi_permohonan_merek_success' => true,
            'link' => route('permohonan.pendaftaran-merek.show', $no_permohonan),
            'no_permohonan' => $no_permohonan,
            'nama_merek' => $data['nama_merek']
        ]);
    }

    public function showPendaftaranMerek($no_permohonan)
    {
        $pendaftaran_merek = PendaftaranMerek::where('no_permohonan', $no_permohonan)->first();
        return view('dashboard.permohonan.lihat-pendaftaran-merek', compact(['pendaftaran_merek']));
    }

    public function deletePendaftaranMerek($id)
    {
        if ($pendaftaran_merek = PendaftaranMerek::findOrFail($id)) {
            $pendaftaran_merek->delete();
        } else {
            return redirect()->route('permohonan')->with([
                'delete_pendaftaran_merek_success' => false,
                'message' => 'Terjadi kesalahan server saat menghapus pendaftaran merek!'
            ]);
        }
        return redirect()->route('permohonan')->with([
            'delete_pendaftaran_merek_success' => true,
            'message' => 'Pendaftaran Merek berhasil dihapus!'
        ]);
    }

    // Admin
    public function permohonanAdmin()
    {
        $pendaftaran_mereks = PendaftaranMerek::latest()->paginate($this->perPage);
        return view('dashboard.permohonan.admin.permohonan', compact(['pendaftaran_mereks']));
    }

    public function adminShowPendaftaranMerek($no_permohonan)
    {
        $pendaftaran_merek = PendaftaranMerek::where('no_permohonan', $no_permohonan)->first();
        return view('dashboard.permohonan.admin.lihat-pendaftaran-merek', compact(['pendaftaran_merek']));
    }
}
