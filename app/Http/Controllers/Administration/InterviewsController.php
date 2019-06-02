<?php

namespace App\Http\Controllers\Administration;

use App\Models\Interview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InterviewsController extends Controller
{
    public function index(Request $request)
    {
        $interviews = Interview::all();

        $calendar = \Calendar::addEvents($interviews)->setOptions([
            'firstDay' => 1,
            'minTime' => config('admissions.working_hours.start'),
            'maxTime' => config('admissions.working_hours.end')
        ]);

        return view('administration.interviews.index', ['interviews' => $interviews, 'calendar' => $calendar]);
    }
}
