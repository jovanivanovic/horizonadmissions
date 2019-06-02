<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use MaddHatter\LaravelFullcalendar\Event;

class Interview extends Model implements Event
{
    protected $dates = [
        'datetime'
    ];

    protected $guarded = [
        'id'
    ];

    private $colors = [
        'pending' => '#f39c12',
        'rejected' => '#dd4b39',
        'confirmed' => '#00a65a',
    ];

    private $options = [];

    public function type()
    {
        return $this->belongsTo(InterviewType::class, 'type_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class);
    }

    public function getTitle()
    {
        return $this->student->full_name . ': ' . $this->type->name;
    }

    public function isAllDay()
    {
        return false;
    }

    public function getStart()
    {
        return $this->datetime;
    }

    public function getEnd()
    {
        return $this->datetime->addHour();
    }

    public function getEventOptions()
    {
        $this->options['color'] = $this->colors[$this->status];

        return $this->options;
    }
}
