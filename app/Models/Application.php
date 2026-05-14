<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Assignment;

class Application extends Model
{
    protected $fillable = [
        'applicant_id',
        'jenis_rpl',
        'prodi_id',
        'konsentrasi_id',
        'status',
        'rejection_note'
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

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function konsentrasi()
    {
        return $this->belongsTo(Konsentrasi::class);
    }

    public function documents()
    {
        return $this->hasMany(ApplicationDocument::class);
    }

    public function learningExperiences()
    {
        return $this->hasMany(LearningExperience::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function latestAssignment()
    {
        return $this->hasOne(Assignment::class)->latestOfMany();
    }
}
