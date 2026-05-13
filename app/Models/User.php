<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\VerifyEmailNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'email_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function applicant()
    {
        return $this->hasOne(Applicant::class);
    }

    public function asesor()
    {
        return $this->hasOne(Asesor::class);
    }

    public function rplManager()
    {
        return $this->hasOne(RplManager::class);
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification);
    }
}