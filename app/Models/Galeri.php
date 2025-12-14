<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Galeri extends Model
{
    protected $table = 'galeris';

    protected $fillable = [
        'judul','slug','gambar','deskripsi','tagar'
    ];

    public function comments()
    {
        return $this->hasMany(GaleriComment::class, 'galeri_id')->latest();
    }

    protected static function booted()
    {
        static::creating(function ($galeri) {
            $galeri->slug = Str::slug($galeri->judul).'-'.Str::random(5);
        });

        static::updating(function ($galeri) {
            if ($galeri->isDirty('judul')) {
                $galeri->slug = Str::slug($galeri->judul).'-'.Str::random(5);
            }
        });
    }

    // helper: ambil tags jadi array
    public function getTagArrayAttribute()
    {
        if (!$this->tagar) return [];
        return array_filter(array_map('trim', explode(',', $this->tagar)));
    }
}
