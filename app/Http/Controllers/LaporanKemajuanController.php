<?php

namespace App\Http\Controllers;

use App\Models\LaporanKemajuan;
use App\Models\Proposal;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanKemajuanController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $proposals = Proposal::all();
            $laporanKemajuans = LaporanKemajuan::with(['proposal', 'user'])->get();
        }else {
            $proposals = Proposal::where('user_id', auth()->user()->id)->get();
            $laporanKemajuans = LaporanKemajuan::with(['proposal', 'user'])->where('user_id', Auth::user()->id)->get();
        }
        return view('laporan_kemajuans.index', compact('laporanKemajuans', 'proposals'));
    }

    public function indexPenelitian()
    {
        if (auth()->user()->role == 'admin') {
            $proposals = Proposal::all();
            $laporanKemajuans = LaporanKemajuan::with(['proposal', 'user'])
            ->whereHas('proposal', function ($query) {
                $query->where('jenis', 'penelitian');
            })
            ->get();
        }else {
            $proposals = Proposal::where('user_id', auth()->user()->id)->get();
            $laporanKemajuans = LaporanKemajuan::with(['proposal', 'user'])
            ->where('user_id', auth()->user()->id)
            ->whereHas('proposal', function ($query) {
                $query->where('jenis', 'penelitian');
            })
            ->get();
        }
        return view('laporan_kemajuans.index', compact('laporanKemajuans', 'proposals'));
    }

    public function indexPengabdian()
    {
        if (auth()->user()->role == 'admin') {
            $proposals = Proposal::all();
            $laporanKemajuans = LaporanKemajuan::with(['proposal', 'user'])
            ->whereHas('proposal', function ($query) {
                $query->where('jenis', 'pengabdian');
            })
            ->get();
        }else {
            $proposals = Proposal::where('user_id', auth()->user()->id)->get();
            $laporanKemajuans = LaporanKemajuan::with(['proposal', 'user'])
            ->where('user_id', auth()->user()->id)
            ->whereHas('proposal', function ($query) {
                $query->where('jenis', 'pengabdian');
            })
            ->get();
        }
        return view('laporan_kemajuans.index', compact('laporanKemajuans', 'proposals'));
    }

    public function create()
    {
        return view('laporan_kemajuans.create');
    }

    public function store(Request $request)
    {
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('laporan_kemajuans', $fileName, 'public');

        LaporanKemajuan::create([ 
            'user_id' => Auth::user()->id,
            'id_proposal' => $request->id_proposal,
            'file' => $filePath,
            'tanggal_upload' => now(),
        ]);

        return redirect()->route('laporan_kemajuans.index')->with('success', 'Laporan Kemajuan berhasil diupload.');
    }

    public function show(LaporanKemajuan $laporanKemajuan)
    {
        return view('laporan_kemajuans.show', compact('laporanKemajuan'));
    }

    public function edit(LaporanKemajuan $laporanKemajuan)
    {
        return view('laporan_kemajuans.edit', compact('laporanKemajuan'));
    }

    public function update(Request $request, LaporanKemajuan $laporanKemajuan)
    {
        $request->validate([
            'judul' => 'required',
            'jenis_laporan_kemajuan' => 'required|in:penelitian kualitatif,penelitian pengembangan,pengabdian masyarakat',
            'jenis' => 'required|in:penelitian,pengabdian',
            'file' => 'nullable|mimes:pdf|max:2048',
        ]);

        $laporanKemajuan->judul = $request->judul;
        $laporanKemajuan->jenis_laporan_kemajuan = $request->jenis_laporan_kemajuan;
        $laporanKemajuan->jenis = $request->jenis;

        if ($request->hasFile('file')) {
            Storage::delete('public/' . $laporanKemajuan->file);
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('laporan_kemajuans', $fileName, 'public');
            $laporanKemajuan->file = $filePath;
        }

        $laporanKemajuan->save();

        return redirect()->route('laporan_kemajuans.index')->with('success', 'Laporan Kemajuan berhasil diperbarui.');
    }

    public function destroy(LaporanKemajuan $laporanKemajuan)
    {
        Storage::delete('public/' . $laporanKemajuan->file);
        $laporanKemajuan->delete();
        return redirect()->route('laporan_kemajuans.index')->with('success', 'Laporan Kemajuan berhasil dihapus.');
    }
}