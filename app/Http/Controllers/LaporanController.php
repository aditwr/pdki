<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\PendaftaranMerek;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tanggalAwal = null;
        $tanggalAkhir = null;
        $pendaftaran_mereks = PendaftaranMerek::query();
        if (isset($request->tanggalAwal)) {
            $pendaftaran_mereks->where('created_at', '>=', $request->tanggalAwal);
            $tanggalAwal = $request->tanggalAwal;
        }
        if (isset($request->tanggalAkhir)) {
            $pendaftaran_mereks->where('created_at', '<=',  $request->tanggalAkhir);
            $tanggalAkhir = $request->tanggalAkhir;
        }
        $pendaftaran_mereks = $pendaftaran_mereks->latest()->get();
        return view('dashboard.laporan.laporan', compact(['pendaftaran_mereks', 'tanggalAwal', 'tanggalAkhir']));
    }

    public function cetak_pdf(Request $request)
    {
        $pendaftaran_mereks = PendaftaranMerek::query();
        if (isset($request->tanggalAwal)) {
            $pendaftaran_mereks->where('created_at', '>=', $request->tanggalAwal);
        }
        if (isset($request->tanggalAkhir)) {
            $pendaftaran_mereks->where('created_at', '<=',  $request->tanggalAkhir);
        }
        $pendaftaran_mereks = $pendaftaran_mereks->latest()->get();
        $pdf = Pdf::loadView('dashboard.laporan.laporan_pdf', ['pendaftaran_mereks' => $pendaftaran_mereks]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('laporan-pendaftaran-merek.pdf');
    }
}
