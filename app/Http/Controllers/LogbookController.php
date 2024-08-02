<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogbookController extends Controller
{
    public function index()
    {
        $logbooks = Logbook::all();
        return view('logbooks.index', compact('logbooks'));
    }

    public function create()
    {
        return view('logbooks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kegiatan' => 'required',
        ]);

        Logbook::create([
            'dosen_id' => Auth::user()->dosen->id,
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