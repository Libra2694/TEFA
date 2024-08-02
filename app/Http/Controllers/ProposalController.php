<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProposalController extends Controller
{
    public function index()
    {
        $proposals = Proposal::all();
        return view('proposals.index', compact('proposals'));
    }

    public function indexPenelitian()
    {
        $proposals = Proposal::where('jenis', 'Penelitian')->get();
        return view('proposals.index', compact('proposals'));
    }

    public function indexPengabdian()
    {
        $proposals = Proposal::where('jenis', 'Pengabdian')->get();
        return view('proposals.index', compact('proposals'));
    }

    public function create()
    {
        return view('proposals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'jenis_proposal' => 'required',
            'jenis' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('proposals', $fileName, 'public');

        Proposal::create([
            'dosen_id' => Auth::user()->dosen->id,
            'judul' => $request->judul,
            'tanggal_upload' => now(),
            'jenis_proposal' => $request->jenis_proposal,
            'jenis' => $request->jenis,
            'file' => $filePath,
        ]);

        return redirect()->route('proposals.index')->with('success', 'Proposal berhasil diupload.');
    }

    public function show(Proposal $proposal)
    {
        return view('proposals.show', compact('proposal'));
    }

    public function edit(Proposal $proposal)
    {
        return view('proposals.edit', compact('proposal'));
    }

    public function update(Request $request, Proposal $proposal)
    {
        $request->validate([
            'judul' => 'required',
            'jenis_proposal' => 'required',
            'jenis' => 'required',
            'file' => 'nullable|mimes:pdf, docx|max:2048',
        ]);

        $proposal->judul = $request->judul;
        $proposal->jenis_proposal = $request->jenis_proposal;
        $proposal->jenis = $request->jenis;

        if ($request->hasFile('file')) {
            Storage::delete('public/' . $proposal->file);
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('proposals', $fileName, 'public');
            $proposal->file = $filePath;
        }

        $proposal->save();

        return redirect()->route('proposals.index')->with('success', 'Proposal berhasil diperbarui.');
    }

    public function destroy(Proposal $proposal)
    {
        Storage::delete('public/' . $proposal->file);
        $proposal->delete();
        return redirect()->route('proposals.index')->with('success', 'Proposal berhasil dihapus.');
    }
}
