<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administratorRole = Role::where('name', 'administrator')->first();
        $staffRole = Role::where('name', 'staff')->first();
        $studentRole = Role::where('name', 'student')->first();

        $administrator = User::create(
            [
                'first_name' => 'Admissions',
                'last_name' => 'CloudHorizon',
                'email' => 'admissions@cloudhorizon.com',
                'phone' => '+15143168391',
                'password' => Hash::make('admissions')
            ]
        );

        $staff = User::create(
            [
                'first_name' => 'Staff',
                'last_name' => 'CloudHorizon',
                'email' => 'staff@cloudhorizon.com',
                'phone' => '+15143168391',
                'password' => Hash::make('admissions')
            ]
        );

        $student = User::create(
            [
                'first_name' => 'Student',
                'last_name' => 'CloudHorizon',
                'email' => 'student@cloudhorizon.com',
                'phone' => '+15143168391',
                'password' => Hash::make('admissions')
            ]
        );

        $administrator->attachRole($administratorRole);
        $staff->attachRole($staffRole);
        $student->attachRole($studentRole);
    }
}
