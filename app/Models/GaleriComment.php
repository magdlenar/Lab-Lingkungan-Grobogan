<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriComment extends Model
{
    protected $table = 'galeri_comments';

    protected $fillable = [
        'galeri_id','nama','komentar'
    ];

    public function galeri()
    {
        return $this->belongsTo(Galeri::class, 'galeri_id');
    }
    
}
