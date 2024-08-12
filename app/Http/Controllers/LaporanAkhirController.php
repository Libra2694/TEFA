<?php

namespace App\Http\Controllers;

use App\Models\LaporanAkhir;
use App\Models\LaporanKemajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanAkhirController extends Controller
{
    public function index()
    {
        if(auth()->user()->role == 'admin')
        {
            $laporanAkhirs = LaporanAkhir::with(['user', 'laporanKemajuan'])->get();
            $laporanKemajuan = LaporanKemajuan::with(['user','proposal'])->get();
        }
        else
        {
            $laporanAkhirs = LaporanAkhir::with(['user', 'laporanKemajuan.proposal'])->where('user_id', auth()->user()->id)->get();
            // dd($laporanAkhirs);
            $laporanKemajuan = LaporanKemajuan::with(['user','proposal'])->where('user_id', auth()->user()->id)->get();
        }

        return view('laporan_akhirs.index', compact('laporanAkhirs', 'laporanKemajuan'));
    }

    public function indexPenelitian()
    {
        if (auth()->user()->role == 'admin') {
            $laporanAkhirs = LaporanAkhir::with(['user', 'laporanKemajuan'])
                ->whereHas('laporanKemajuan', function ($query) {
                    $query->whereHas('proposal', function ($subQuery) {
                        $subQuery->where('jenis', 'penelitian');
                    });
                })->get();
                $laporanKemajuan = LaporanKemajuan::with(['user','proposal'])->where('user_id', auth()->user()->id)->whereHas('proposal', function ($query) {
                $query->where('jenis', 'penelitian');
            })
            ->get();
        } else {
            $laporanAkhirs = LaporanAkhir::with(['user', 'laporanKemajuan'])
                ->where('user_id', auth()->user()->id)
                ->whereHas('laporanKemajuan', function ($query) {
                    $query->whereHas('proposal', function ($subQuery) {
                        $subQuery->where('jenis', 'penelitian');
                    });
                })->get();
                $laporanKemajuan = LaporanKemajuan::with(['user','proposal'])->where('user_id', auth()->user()->id)->whereHas('proposal', function ($query) {
                $query->where('jenis', 'penelitian');
            })
            ->get();
            
        }
    
        return view('laporan_akhirs.index', compact('laporanAkhirs', 'laporanKemajuan'));
    }    
    
    public function indexPengabdian()
    {
        if (auth()->user()->role == 'admin') {
            $laporanAkhirs = LaporanAkhir::with(['user', 'laporanKemajuan'])
                ->whereHas('laporanKemajuan', function ($query) {
                    $query->whereHas('proposal', function ($subQuery) {
                        $subQuery->where('jenis', 'pengabdian');
                    });
                })->get();
                $laporanKemajuan = LaporanKemajuan::with(['user','proposal'])->where('user_id', auth()->user()->id)->whereHas('proposal', function ($query) {
                $query->where('jenis', 'pengabdian');
            })
            ->get();
        } else {
            $laporanAkhirs = LaporanAkhir::with(['user', 'laporanKemajuan'])    
                ->where('user_id', auth()->user()->id)
                ->whereHas('laporanKemajuan', function ($query) {
                    $query->whereHas('proposal', function ($subQuery) {
                        $subQuery->where('jenis', 'pengabdian');
                    });
                })->get();
                $laporanKemajuan = LaporanKemajuan::with(['user','proposal'])->where('user_id', auth()->user()->id)->whereHas('proposal', function ($query) {
                $query->where('jenis', 'pengabdian');
            })
            ->get();
        }
    
        return view('laporan_akhirs.index', compact('laporanAkhirs', 'laporanKemajuan'));
    }    

    public function create()
    {
        return view('laporan_akhirs.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048', // Adjust mime types and max size as needed
        ]);

        // Handle the file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('laporan_akhir_files', $filename, 'public');
        }

        LaporanAkhir::create([
            'user_id' => Auth::user()->id,
            'laporan_kemajuan_id' => $request->laporan_kemajuan_id,
            'file' => $path,
        ]);

        return redirect()->route('laporan_akhirs.index')->with('success', 'Laporan Akhir berhasil diupload.');
    }

    public function show(LaporanAkhir $laporanAkhir)
    {
        return view('laporan_akhirs.show', compact('laporanAkhir'));
    }

    public function edit(LaporanAkhir $laporanAkhir)
    {
        return view('laporan_akhirs.edit', compact('laporanAkhir'));
    }

    public function update(Request $request, LaporanAkhir $laporanAkhir)
    {
        // Validate the incoming request data
        $request->validate([
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Adjust mime types and max size as needed
        ]);
    
        // Handle the file upload if a new file is uploaded
        if ($request->hasFile('file')) {
            // Delete the old file if it exists
            if ($laporanAkhir->file && Storage::disk('public')->exists($laporanAkhir->file)) {
                Storage::disk('public')->delete($laporanAkhir->file);
            }
    
            // Upload the new file
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('laporan_akhir_files', $filename, 'public');
    
            // Update the file path in the database
            $laporanAkhir->file = $filePath;
        }
    
        // Update other fields
        $laporanAkhir->laporan_kemajuan_id = $request->laporan_kemajuan_id;
        $laporanAkhir->save();
    
        return redirect()->route('laporan_akhirs.index')->with('success', 'Laporan Akhir berhasil diperbarui.');
    }    

    public function destroy(LaporanAkhir $laporanAkhir)
    {
        Storage::delete('public/' . $laporanAkhir->file);
        $laporanAkhir->delete();
        return redirect()->route('laporan_akhirs.index')->with('success', 'Laporan Akhir berhasil dihapus.');
    }
}
