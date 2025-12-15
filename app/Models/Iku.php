<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iku extends Model
{
    use HasFactory;

    protected $fillable = [
        'kabupaten_kota',
        'tanggal',          
        'rataan_no2',
        'rataan_so2',
        'indeks_no2',
        'indeks_so2',
        'rataan_indeks',
        'nilai_iku',
        'target_iku',
    ];
}
