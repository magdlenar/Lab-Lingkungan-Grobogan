<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabDocument extends Model
{
    protected $table = 'lab_documents';

    protected $fillable = [
        'sop_file',
        'sk_sop_file',
    ];
}
