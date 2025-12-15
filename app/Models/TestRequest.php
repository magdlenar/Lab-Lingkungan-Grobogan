<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pic_name',
        'pic_phone',
        'pic_email',
        'sample_address',
        'service_type',
        'notes',
        'letter_file',
        'status',
        'fix_fields',
        'sample_pickup_date',
        'pickup_letter_file',
    ];

    // RELASI KE USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function result()
    {
        return $this->hasOne(\App\Models\TestResult::class, 'test_request_id');
    }

}
