<?php

namespace App\Http\Requests\Students;

use Illuminate\Foundation\Http\FormRequest;

class CreateInterviewFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasRole('student');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type_id' => 'required|unique_with:interviews,student_id',
            'datetime' => 'required|date|unique:interviews'
        ];
    }
}
