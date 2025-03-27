<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\TrainingTitle;
use Carbon\Carbon;

class MasterController extends Controller
{
    public function home()
    {
        // Get current day, month (formatted as full month name), and year
        $todayDay = Carbon::now()->day;
        $todayMonth = Carbon::now()->format('F'); // Converts month number to full name
        $todayYear = Carbon::now()->year;

        // Count all training titles
        $training_title = TrainingTitle::count();

        // Count trainings happening today (Fix for comma-separated values)
        $currentTrainings = TrainingTitle::whereRaw("FIND_IN_SET(?, training_day)", [$todayDay])
                            ->where('training_month', $todayMonth)
                            ->where('training_year', $todayYear)
                            ->count();

        // Count trainings for the current month
        $currentMonthTrainings = TrainingTitle::where('training_month', $todayMonth)
                                    ->where('training_year', $todayYear)
                                    ->count();

        // Count trainings for the current year
        $currentYearTrainings = TrainingTitle::where('training_year', $todayYear)
                                    ->count();

        return view('home.dashboard', compact(
            'training_title', 
            'currentTrainings', 
            'currentMonthTrainings', 
            'currentYearTrainings'
        ));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout Successfully');
    }
}

   


