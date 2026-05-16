<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Assessment extends Model
{
    protected $fillable = [
        'application_id',
        'asesor_id',
        'notes',
        'status',
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

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function asesor()
    {
        return $this->belongsTo(Asesor::class);
    }

    public function assessmentDetails()
    {
        return $this->hasMany(AssessmentDetail::class);
    }
}
