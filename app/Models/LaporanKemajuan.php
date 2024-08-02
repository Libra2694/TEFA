<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKemajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'dosen_id',
        'judul',
        'tanggal_upload',
        'jenis_laporan_kemajuan',
        'jenis',
        'file',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}