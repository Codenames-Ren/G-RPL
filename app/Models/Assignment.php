<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Assignment extends Model
{
    protected $fillable = [
        'application_id',
        'manager_id',
        'asesor_id',
        'assigned_at',
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

    public function manager()
    {
        return $this->belongsTo(RplManager::class, 'manager_id');
    }
}
