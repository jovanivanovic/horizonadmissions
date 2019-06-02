<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        switch (auth()->user()->role->name) {
            case "administrator":
                return redirect()->route('admin.interviews');
                break;

            case "staff":
                return redirect()->route('staff.interviews');
                break;

            case "student":
                return redirect()->route('student.interviews');
                break;

            default:
                return redirect()->route('student.interviews');
                break;
        }
    }
}
