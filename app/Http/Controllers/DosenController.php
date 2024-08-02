<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::paginate(10); // Pagination for better performance with many records
        return view('dosens.index', compact('dosens'));
    }

    public function create()
    {
        $users = User::where('role', 'user')->doesntHave('dosen')->get();
        return view('dosens.create', compact('users'));
    }

    public function store(Request $request)
    {
        // Validation rules
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nidn' => 'required|unique:dosens',
            'kelamin' => 'required|in:laki-laki,perempuan',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
            'prodi' => 'required',
            'jabatan' => 'required',
            'pangkat' => 'required',
        ]);

        // Create the Dosen record
        Dosen::create($validatedData);

        // Redirect with success message
        return redirect()->route('dosens.index')->with('success', 'Data dosen berhasil ditambahkan.');
    }

    public function show(Dosen $dosen)
    {
        return view('dosens.show', compact('dosen'));
    }

    public function edit(Dosen $dosen)
    {
        return view('dosens.edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        // Validation rules
        $validatedData = $request->validate([
            'nidn' => 'required|unique:dosens,nidn,' . $dosen->id,
            'kelamin' => 'required|in:laki-laki,perempuan',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
            'prodi' => 'required',
            'jabatan' => 'required',
            'pangkat' => 'required',
        ]);

        // Update the Dosen record
        $dosen->update($validatedData);

        // Redirect with success message
        return redirect()->route('dosens.index')->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen)
    {
        // Delete the Dosen record
        $dosen->delete();

        // Redirect with success message
        return redirect()->route('dosens.index')->with('success', 'Data dosen berhasil dihapus.');
    }
}
