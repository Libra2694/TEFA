<?php

namespace App\Http\Controllers;

use App\Models\LaporanKemajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanKemajuanController extends Controller
{
    public function index()
    {
        $laporanKemajuans = LaporanKemajuan::all();
        return view('laporan_kemajuans.index', compact('laporanKemajuans'));
    }

    public function indexPenelitian()
    {
        $laporanKemajuans = LaporanKemajuan::where('jenis', 'penelitian')->get();
        return view('laporan_kemajuans.index', compact('laporanKemajuans'));
    }

    public function indexPengabdian()
    {
        $laporanKemajuans = LaporanKemajuan::where('jenis', 'pengabdian')->get();
        return view('laporan_kemajuans.index', compact('laporanKemajuans'));
    }

    public function create()
    {
        return view('laporan_kemajuans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'jenis_laporan_kemajuan' => 'required|in:penelitian kualitatif,penelitian pengembangan,pengabdian masyarakat',
            'jenis' => 'required|in:penelitian,pengabdian',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('laporan_kemajuans', $fileName, 'public');

        LaporanKemajuan::create([
            'dosen_id' => Auth::user()->dosen->id,
            'judul' => $request->judul,
            'tanggal_upload' => now(),
            'jenis_laporan_kemajuan' => $request->jenis_laporan_kemajuan,
            'jenis' => $request->jenis,
            'file' => $filePath,
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