<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'dosen_id',
        'tanggal',
        'kegiatan',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}