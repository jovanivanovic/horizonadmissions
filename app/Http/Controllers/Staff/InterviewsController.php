<?php

namespace App\Http\Controllers\Staff;

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

        return view('staff.interviews.index', ['interviews' => $interviews, 'calendar' => $calendar]);
    }

    public function confirm(Interview $interview)
    {
        $interview->status = 'confirmed';
        $interview->save();

        return redirect()->route('staff.interviews');
    }

    public function reject(Interview $interview)
    {
        $interview->status = 'rejected';
        $interview->save();

        return redirect()->route('staff.interviews');
    }
}
