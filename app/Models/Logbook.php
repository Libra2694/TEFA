<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'laporan_akhirs_id', // Singular and consistent with convention
        'tanggal',
        'kegiatan',
    ];

    // Relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to the LaporanAkhir model
    public function laporanAkhir() // CamelCase for better readability
    {
        return $this->belongsTo(LaporanAkhir::class, 'laporan_akhirs_id');
    }
}
