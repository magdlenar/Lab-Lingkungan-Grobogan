<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
class User extends Authenticatable implements CanResetPasswordContract
{
    use HasFactory, Notifiable, CanResetPassword;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
        'nomor_hp',
        'instansi',
        'google_id',
        'verification_code',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
public function sendPasswordResetNotification($token)
{
    $url = url(route('password.reset', [
        'token' => $token,
        'email' => $this->email,
    ], false));

    $this->notify(new \App\Notifications\CustomResetPasswordNotification($url));
}
}


