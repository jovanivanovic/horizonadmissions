<?php

namespace App\Http\Controllers\Administration;

use App\Http\Requests\Administration\CreateInterviewTypeFormRequest;
use App\Models\InterviewType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InterviewTypesController extends Controller
{
    public function index(Request $request)
    {
        $interview_types = InterviewType::all();

        return view('administration.interview_types.index', ['interview_types' => $interview_types]);
    }

    public function show(InterviewType $interview_type)
    {
        $interviews = $interview_type->interviews;

        $calendar = \Calendar::addEvents($interviews)->setOptions([
            'firstDay' => 1,
            'minTime' => config('admissions.working_hours.start'),
            'maxTime' => config('admissions.working_hours.end')
        ]);

        return view('administration.interview_types.show', [
            'interview_type' => $interview_type,
            'calendar' => $calendar,
            'interviews' => $interviews
        ]);
    }

    public function create()
    {
        return view('administration.interview_types.create');
    }

    public function edit(InterviewType $interview_type)
    {
        return view('administration.interview_types.edit', [
            'interview_type' => $interview_type,
        ]);
    }

    public function delete(InterviewType $interview_type)
    {
        return view('administration.interview_types.delete', [
            'interview_type' => $interview_type
        ]);
    }

    public function destroy(Request $request, InterviewType $interview_type)
    {
        if ($request->has('yes')) {
            $interview_type->delete();
        }

        return redirect()->route('admin.interview_types');
    }

    public function store(CreateInterviewTypeFormRequest $request)
    {
        $interview_type = InterviewType::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.interview_types');
    }

    public function update(CreateInterviewTypeFormRequest $request, InterviewType $interview_type)
    {
        $interview_type->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.interview_types');
    }
}
