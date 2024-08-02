<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nidn',
        'kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'nomor_telepon',
        'prodi',
        'jabatan',
        'pangkat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function laporanKemajuans()
    {
        return $this->hasMany(LaporanKemajuan::class);
    }

    public function laporanAkhirs()
    {
        return $this->hasMany(LaporanAkhir::class);
    }

    public function logbooks()
    {
        return $this->hasMany(Logbook::class);
    }
}