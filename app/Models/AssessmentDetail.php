<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AssessmentDetail extends Model
{
    protected $fillable = [
        'assessment_id',
        'learning_experience_id',
        'course_id',
        'sks_diakui',
        'nilai_konversi',
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

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function learningExperience()
    {
        return $this->belongsTo(LearningExperience::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
