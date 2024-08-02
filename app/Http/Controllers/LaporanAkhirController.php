<?php

namespace App\Http\Controllers;

use App\Models\LaporanAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanAkhirController extends Controller
{
    public function index()
    {
        $laporanAkhirs = LaporanAkhir::all();
        return view('laporan_akhirs.index', compact('laporanAkhirs'));
    }

    public function indexPenelitian()
    {
        $laporanAkhirs = LaporanAkhir::where('jenis', 'Penelitian')->get();
        return view('laporan_akhirs.index', compact('laporanAkhirs'));
    }

    public function indexPengabdian()
    {
        $laporanAkhirs = LaporanAkhir::where('jenis', 'Pengabdian')->get();
        return view('laporan_akhirs.index', compact('laporanAkhirs'));
    }

    public function create()
    {
        return view('laporan_akhirs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_laporan_akhir' => 'required|in:penelitian kualitatif,penelitian pengembangan,pengabdian masyarakat',
            // validasi lainnya
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('laporan_akhirs', $fileName, 'public');

        LaporanAkhir::create([
            'dosen_id' => Auth::user()->dosen->id,
            'judul' => $request->judul,
            'tanggal_upload' => now(),
            'jenis_laporan_akhir' => $request->jenis_laporan_akhir,
            'jenis' => $request->jenis,
            'file' => $filePath,
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
        $request->validate([
            'judul' => 'required',
            'jenis_laporan_akhir' => 'required',
            'jenis' => 'required',
            'file' => 'nullable|mimes:pdf|max:2048',
        ]);

        $laporanAkhir->judul = $request->judul;
        $laporanAkhir->jenis_laporan_akhir = $request->jenis_laporan_akhir;
        $laporanAkhir->jenis = $request->jenis;

        if ($request->hasFile('file')) {
            Storage::delete('public/' . $laporanAkhir->file);
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('laporan_akhirs', $fileName, 'public');
            $laporanAkhir->file = $filePath;
        }

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
