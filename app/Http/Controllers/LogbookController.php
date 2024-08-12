<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\LaporanAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogbookController extends Controller
{
    public function index()
    {  
        if (Auth::user()->role == 'admin') {
            $logbooks = Logbook::with(['user', 'laporanAkhir.laporanKemajuan.proposal'])->get();
            $laporan_akhir = LaporanAkhir::with(['user', 'laporanKemajuan.proposal'])->whereHas('user', function ($query) {
                $query->whereColumn('users.id', 'laporan_akhirs.user_id');
            })->get();
            
        }
        else
        {
            $logbooks = Logbook::with(['user', 'laporanAkhir.laporanKemajuan.proposal'])->where('user_id', Auth::user()->id)->get();
            $laporan_akhir = LaporanAkhir::with(['user','laporanKemajuan.proposal'])->where('user_id', Auth::user()->id)->get();
        }
        return view('logbooks.index', compact('logbooks', 'laporan_akhir'));
    }

    public function create()
    {
        return view('logbooks.create');
    }

    public function store(Request $request)
    {
        Logbook::create([
            'user_id' => Auth::user()->id,
            'laporan_akhirs_id' => $request->laporan_akhirs_id,
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan,
        ]);

        return redirect()->route('logbooks.index')->with('success', 'Logbook berhasil ditambahkan.');
    }

    public function show(Logbook $logbook)
    {
        return view('logbooks.show', compact('logbook'));
    }

    public function edit(Logbook $logbook)
    {
        return view('logbooks.edit', compact('logbook'));
    }

    public function update(Request $request, Logbook $logbook)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kegiatan' => 'required',
            'laporan_akhirs_id' => 'required',
        ]);

        $logbook->update($request->all());

        return redirect()->route('logbooks.index')->with('success', 'Logbook berhasil diperbarui.');
    }

    public function destroy(Logbook $logbook)
    {
        $logbook->delete();
        return redirect()->route('logbooks.index')->with('success', 'Logbook berhasil dihapus.');
    }
}