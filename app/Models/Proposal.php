<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LaporanKemajuan;

class Proposal extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi secara massal
    protected $guarded = [];

    // Menentukan kolom yang harus di-cast
    protected $casts = [
        'tanggal_upload' => 'datetime',
    ];

    // Relasi dengan model Dosen
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function laporan_kemajuan()
    {
        return $this->belongsTo(LaporanKemajuan::class);
    }
}
