<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\InterviewType;

class InterviewTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $freshmanInterview = InterviewType::create(
            [
                'name' => 'Freshman interview',
                'description' => 'An interview is not a required part of the application process, but we encourage you to meet and talk with student interviewer
',
                'status' => true
            ]
        );

        $transferInterview = InterviewType::create(
            [
                'name' => 'Transfer interview',
                'description' => 'Formal admission interviews are required for transfer applicants',
                'status' => true
            ]
        );
    }
}
