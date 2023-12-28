<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function image(Request $request)
    {
        if ($request->hasFile('logo_merek')) {
            // filepond temporary upload path
            $file = $request->file('logo_merek');
            $filename = time() . auth()->user()->id . '.' .  $file->getClientOriginalExtension();
            $folder_tmp = uniqid() . '-' . now()->timestamp;
            $file->storeAs('tmp/logo_merek/' . $folder_tmp, $filename);
            return response()->json([
                'success' => true,
                'filename' => $filename,
                'folder_tmp' => $folder_tmp
            ]);
        }

        if ($request->hasFile('surat_keterangan_umk')) {
            $file = $request->file('surat_keterangan_umk');
            $filename = time() . auth()->user()->id . '.' .  $file->getClientOriginalExtension();
            $folder_tmp = uniqid() . '-' . now()->timestamp;
            $file->storeAs('tmp/surat_keterangan_umk/' . $folder_tmp, $filename);
            return response()->json([
                'success' => true,
                'filename' => $filename,
                'folder_tmp' => $folder_tmp
            ]);
        }

        if ($request->hasFile('tanda_tangan_pemohon')) {
            $file = $request->file('tanda_tangan_pemohon');
            $filename = time() . auth()->user()->id . '.' .  $file->getClientOriginalExtension();
            $folder_tmp = uniqid() . '-' . now()->timestamp;
            $file->storeAs('tmp/tanda_tangan_pemohon/' . $folder_tmp, $filename);
            return response()->json([
                'success' => true,
                'filename' => $filename,
                'folder_tmp' => $folder_tmp
            ]);
        }

        // request failed
        return response()->json([
            'success' => false,
            'message' => 'File failed to upload'
        ]);
    }
}
