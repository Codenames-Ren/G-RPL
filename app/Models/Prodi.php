<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Prodi extends Model
{
    protected $fillable = [
        'nama_prodi',
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function konsentrasis()
    {
        return $this->hasMany(Konsentrasi::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function asesors()
    {
        return $this->belongsToMany(Asesor::class,'asesor_prodis');
    }
}
