<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'verification_code',
        'verification_code_expires_at',
        'reset_token',
        'reset_token_expires_at',
        'is_active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'verification_code',
        'reset_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'verification_code_expires_at' => 'datetime',
        'reset_token_expires_at' => 'datetime',
        'is_active' => 'boolean'
    ];

    // Mutator untuk auto-hash password
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    // Check apakah email sudah terverifikasi
    public function hasVerifiedEmail()
    {
        return !is_null($this->email_verified_at);
    }

    // Generate kode verifikasi 6 digit
    public function generateVerificationCode()
    {
        $this->verification_code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $this->verification_code_expires_at = now()->addMinutes(15);
        $this->save();
        
        return $this->verification_code;
    }

    // Generate reset token
    public function generateResetToken()
    {
        $this->reset_token = bin2hex(random_bytes(32));
        $this->reset_token_expires_at = now()->addHour();
        $this->save();
        
        return $this->reset_token;
    }

    // Verifikasi email
    public function markEmailAsVerified()
    {
        $this->email_verified_at = now();
        $this->verification_code = null;
        $this->verification_code_expires_at = null;
        $this->save();
    }
}