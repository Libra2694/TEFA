<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanAkhir extends Model
{
    use HasFactory;

    protected $fillable = [
        'dosen_id',
        'judul',
        'tanggal_upload',
        'jenis_laporan_akhir',
        'jenis',
        'file',
    ];

    // Menambahkan cast untuk tanggal_upload agar menjadi objek Carbon
    protected $casts = [
        'tanggal_upload' => 'datetime',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
