<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'student') {
            abort(403, 'Unauthorized access.');
        }
        
        $userId = auth()->id();
        
        $totalApplications = Application::where('student_id', $userId)->count();
        $pendingApplications = Application::where('student_id', $userId)
                                         ->whereIn('status', ['pending', 'assigned', 'reviewed'])
                                         ->count();
        $awardedApplications = Application::where('student_id', $userId)
                                          ->where('status', 'approved')
                                          ->count();
        
        $recentApplications = Application::where('student_id', $userId)
                                         ->with('scholarship')
                                         ->latest()
                                         ->take(5)
                                         ->get();
        
        return view('student.dashboard', compact(
            'totalApplications',
            'pendingApplications', 
            'awardedApplications',
            'recentApplications'
        ));
    }
}