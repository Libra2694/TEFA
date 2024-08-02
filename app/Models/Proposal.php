<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'dosen_id',
        'judul',
        'tanggal_upload',
        'jenis_proposal',
        'jenis',
        'file',
    ];

    // Menentukan kolom yang harus di-cast
    protected $casts = [
        'tanggal_upload' => 'datetime',
    ];

    // Relasi dengan model Dosen
    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
