<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ika extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_lokasi','alamat','sungai','tanggal','kategori',
        'latitude','longitude','kelas1','kelas2','kelas3','kelas4'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'latitude' => 'decimal:6',
        'longitude' => 'decimal:6',
    ];
}
