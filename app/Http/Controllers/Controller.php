<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Meeting;
use App\Models\Report;
use App\Models\Reservation;
use App\Models\Test;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $users_male_count = User::where('gender', 'ذكر')->count();
        $users_female_count = User::where('gender', 'انثي')->count();
        $doctors_male_count = Doctor::where('gender', 'ذكر')->count();
        $doctors_female_count = Doctor::where('gender', 'انثي')->count();
        $meetings_count = Meeting::where('doctor_id', null)->count();
        $reservations_count = Reservation::where('status', 'انتظار')->count();
        $reports_count = Report::where('doctor_id', null)->count();
        $hospitals_count = Hospital::count();

        return view('pages.home', compact([
            'users_male_count',
            'users_female_count',
            'doctors_male_count',
            'doctors_female_count',
            'meetings_count',
            'reservations_count',
            'reports_count',
            'hospitals_count'
        ]));
    }
}
