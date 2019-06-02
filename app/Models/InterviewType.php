<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewType extends Model
{
    protected $with = [
        'interviews'
    ];

    protected $guarded = [
        'id'
    ];

    public function interviews()
    {
        return $this->hasMany(Interview::class, 'type_id');
    }

    public function getCountPendingInterviewsAttribute()
    {
        return $this->interviews->where('status', 'pending')->count();
    }

    public function getCountRejectedInterviewsAttribute()
    {
        return $this->interviews->where('status', 'rejected')->count();
    }

    public function getCountConfirmedInterviewsAttribute()
    {
        return $this->interviews->where('status', 'confirmed')->count();
    }
}
