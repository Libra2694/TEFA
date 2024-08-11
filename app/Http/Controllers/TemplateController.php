<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use DB;

class TemplateController extends Controller
{
    public function index() 
    {
        $data['template_pengabdian'] = Template::where('jenis_template', 'pengabdian')
            ->select('kategori_template', 'tipe_template', 'path_template', 'updated_at')
            ->get()
            ->groupBy('kategori_template')
            ->map(function ($items, $kategori) {
                return [
                    'kategori_template' => $kategori,
                    'panduan' => $items->firstWhere('tipe_template', 'panduan'),
                    'template' => $items->firstWhere('tipe_template', 'template'),
                ];
            });
        $data['template_penelitian'] = Template::where('jenis_template', 'penelitian')
            ->select('kategori_template', 'tipe_template', 'path_template', 'updated_at')
            ->get()
            ->groupBy('kategori_template')
            ->map(function ($items, $kategori) {
                return [
                    'kategori_template' => $kategori,
                    'panduan' => $items->firstWhere('tipe_template', 'panduan'),
                    'template' => $items->firstWhere('tipe_template', 'template'),
                ];
            });
        // dd($templatePenelitian);
            
        return view('templates.index', $data);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kategori' => 'required|string',
            'jenis' => 'required|string',
            'file_panduan' => 'nullable|file|mimes:pdf,docx,doc',
            'file_template' => 'nullable|file|mimes:pdf,docx,doc',
        ]);
    
        // Ambil data sesuai kategori dan jenis template
        $panduanTemplate = Template::where('kategori_template', $request->kategori)
            ->where('jenis_template', $request->jenis)
            ->where('tipe_template', 'panduan')
            ->first();
    
        $templateTemplate = Template::where('kategori_template', $request->kategori)
            ->where('jenis_template', $request->jenis)
            ->where('tipe_template', 'template')
            ->first();
    
        // Cek dan simpan file panduan
        if ($request->hasFile('file_panduan')) {
            // Mendapatkan nama asli file dan memastikan nama unik jika ada file dengan nama yang sama
            $panduanFilename = $request->file('file_panduan')->getClientOriginalName();
            $panduanPath = $request->file('file_panduan')->storeAs('panduan_files', $panduanFilename, 'public');
    
            if ($panduanTemplate) {
                $panduanTemplate->path_template = $panduanPath;
                $panduanTemplate->updated_at = now();
                $panduanTemplate->save();
            }
        }
    
        // Cek dan simpan file template
        if ($request->hasFile('file_template')) {
            // Mendapatkan nama asli file dan memastikan nama unik jika ada file dengan nama yang sama
            $templateFilename = $request->file('file_template')->getClientOriginalName();
            $templatePath = $request->file('file_template')->storeAs('template_files', $templateFilename, 'public');
    
            if ($templateTemplate) {
                $templateTemplate->path_template = $templatePath;
                $templateTemplate->updated_at = now();
                $templateTemplate->save();
            }
        }
    
        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Files uploaded successfully');
    }
     

}
