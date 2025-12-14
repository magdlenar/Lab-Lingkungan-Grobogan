<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    protected $fillable = [
        'jabatan','nama','foto','urutan','parent_id'
    ];

    public function parent(){
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(){
        return $this->hasMany(self::class, 'parent_id')->orderBy('urutan');
    }

    // recursive eager load: children -> children -> children...
    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }
}
