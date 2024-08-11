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
        if (auth()->user()->role == 'admin') {
            $proposals = Proposal::with('user')->get();
        } else {
            $proposals = Proposal::with('user')->where('user_id', auth()->user()->id)->get();
        }
        return view('proposals.index', compact('proposals'));
    }
    
    public function indexPenelitian()
    {
        if (auth()->user()->role == 'admin') {
            $proposals = Proposal::with('user')->where('jenis', 'penelitian')->get();
        } else {
            $proposals = Proposal::with('user')->where('user_id', auth()->user()->id)->where('jenis', 'penelitian')->get();
        }
        return view('proposals.index', compact('proposals'));
    }
    
    public function indexPengabdian()
    {
        if (auth()->user()->role == 'admin') {
            $proposals = Proposal::with('user')->where('jenis', 'pengabdian')->get();
        } else {
            $proposals = Proposal::with('user')->where('user_id', auth()->user()->id)->where('jenis', 'pengabdian')->get();
        }
        return view('proposals.index', compact('proposals'));
    }    

    public function create()
    {
        return view('proposals.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048', // Adjust file type and size as needed
        ]);

        $file = $request->file('file');
    
        // Handle file upload
        $filePath = $file->storeAs('proposals', $file->getClientOriginalName());
    
        // Create a new proposal record in the database
        Proposal::create([
            'user_id' => auth()->user()->id,
            'judul' => $request->input('judul'),
            'jenis_proposal' => $request->input('jenis_proposal'),
            'tahun' => $request->input('tahun'),
            'jangka_waktu' => $request->input('jangka_waktu'),
            'biaya' => $request->input('biaya'),
            'sumber_biaya' => $request->input('sumber_biaya'),
            'anggota' => $request->input('anggota'),
            'file' => $filePath,
            'jenis' => $request->input('jenis'), // The hidden input field for 'penelitian' or 'pengabdian'
        ]);
    
        // Redirect back with a success message
        return redirect()->route('proposals.index')->with('success', 'Proposal successfully saved.');
    }    

    public function show(Proposal $proposal)
    {
        return view('proposals.show', compact('proposal'));
    }

    public function edit(Proposal $proposal)
    {
        return view('proposals.edit', compact('proposal'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'judul' => 'required|string|max:255',
            'jenis_proposal' => 'required|string',
            'tahun' => 'required|string|max:4',
            'jangka_waktu' => 'required|string|max:255',
            'biaya' => 'required|numeric',
            'sumber_biaya' => 'required|string|max:255',
            'anggota' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // File is optional in update
        ]);
    
        // Find the existing proposal record
        $proposal = Proposal::findOrFail($id);
    
        // Handle file upload if a new file is provided
        if ($request->hasFile('file')) {
            // Delete the old file if it exists
            if ($proposal->file && Storage::disk('public')->exists($proposal->file)) {
                Storage::disk('public')->delete($proposal->file);
            }

            $file = $request->file('file');
    
            // Handle file upload
            $filePath = $file->storeAs('proposals', $file->getClientOriginalName());
            $proposal->file = $filePath;
        }
    
        // Update the proposal record with the new data
        $proposal->update([
            'judul' => $request->input('judul'),
            'jenis_proposal' => $request->input('jenis_proposal'),
            'tahun' => $request->input('tahun'),
            'jangka_waktu' => $request->input('jangka_waktu'),
            'biaya' => $request->input('biaya'),
            'sumber_biaya' => $request->input('sumber_biaya'),
            'anggota' => $request->input('anggota'),
            'jenis' => $request->input('jenis'), // The hidden input field for 'penelitian' or 'pengabdian'
        ]);
    
        // Redirect back with a success message
        return redirect()->route('proposals.index')->with('success', 'Proposal successfully updated.');
    }

    public function destroy(Proposal $proposal)
    {
        Storage::delete('public/' . $proposal->file);
        $proposal->delete();
        return redirect()->route('proposals.index')->with('success', 'Proposal berhasil dihapus.');
    }
}
