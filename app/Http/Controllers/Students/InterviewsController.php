<?php

namespace App\Http\Controllers\Students;

use App\Http\Requests\Students\CreateInterviewFormRequest;
use App\Models\Interview;
use App\Models\InterviewType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\CarbonInterval;
use Illuminate\Support\Carbon;
use Illuminate\Support\Arr;

class InterviewsController extends Controller
{
    public function index(Request $request)
    {
        $student = auth()->user();
        $interviews = $student->interviews;

        return view('students.interviews.index', ['interviews' => $interviews]);
    }

    private function isInterviewSlotAvailable($from, $to, $interviews)
    {
        foreach ($interviews as $interview) {
            $interviewStart = $interview->getStart();
            $interviewEnd = $interview->getEnd();

            if ($from->between($interviewStart, $interviewEnd) && $to->between($interviewStart, $interviewEnd)) {
                return false;
            }
        }

        return true;
    }

    public function getAvailableInterviewSlots(Request $request)
    {
        $date = $request->get('date');

        if (in_array(Carbon::instance(new \DateTime($date))->dayOfWeek, config('admissions.excluded_days_of_week'))) {
            return response()->json([]);
        }

        $interviews = Interview::whereDate('datetime', '=', $date)->where('status', '!=', 'rejected')->get();

        $start = Carbon::instance(new \DateTime($date . config('admissions.working_hours.start')));
        $end = Carbon::instance(new \DateTime($date . config('admissions.working_hours.end')));

        $slot_length = CarbonInterval::hour(config('admissions.interview_length'));

        $available_slots = [];

        foreach (new \DatePeriod($start, $slot_length, $end) as $slot) {
            $to = $slot->copy()->add($slot_length);

            if ($this->isInterviewSlotAvailable($slot, $to, $interviews)) {
                array_push($available_slots, $slot->format('Y-m-d H:i'));
            }
        }

        return response()->json($available_slots);
    }

    public function create(Request $request)
    {
        $interview_types = InterviewType::where('status', true)->whereDoesntHave('interviews.student', function (Builder $query) {
            $query->where('id', auth()->user()->id);
        })->get();

        return view('students.interviews.create', [
            'interview_types' => $interview_types
        ]);
    }

    public function store(CreateInterviewFormRequest $request)
    {
        $datetime = Carbon::instance(new \DateTime($request->datetime));

        if (Interview::where('datetime', '=', $datetime->format('Y-m-d H:i:s'))->where('status', '!=', 'rejected')->count() == 0) {
            $student = auth()->user();
            $interviews = $student->interviews();

            $interview = $interviews->create([
                'type_id' => $request->type_id,
                'datetime' => $datetime
            ]);
        }

        return redirect()->route('student.interviews');
    }
}
