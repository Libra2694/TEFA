<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanAkhir extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Menambahkan cast untuk tanggal_upload agar menjadi objek Carbon
    protected $casts = [
        'tanggal_upload' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proposal()
    {
        return $this->hasMany(Logbook::class);
    }

    public function laporanKemajuan()
    {
        return $this->belongsTo(LaporanKemajuan::class, 'laporan_kemajuan_id');

    }
}
