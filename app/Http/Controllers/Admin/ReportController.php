<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Scholarship;
use App\Models\Application;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        return view('admin.generate-reports');
    }

    public function generate(Request $request)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $request->validate([
            'report_type' => 'required|in:students,scholarships,reviewers,overall'
        ]);

        switch($request->report_type) {
            case 'students':
                $students = User::where('role', 'student')->with('applications')->get();
                return view('admin.reports.students', compact('students'));
                
            case 'scholarships':
                $scholarships = Scholarship::withCount('applications')->get();
                return view('admin.reports.scholarships', compact('scholarships'));
                
            case 'reviewers':
                $reviewers = User::where('role', 'reviewer')->with('reviewerAssignments')->get();
                return view('admin.reports.reviewers', compact('reviewers'));
                
            case 'overall':
                $totalStudents = User::where('role', 'student')->count();
                $totalReviewers = User::where('role', 'reviewer')->count();
                $totalScholarships = Scholarship::count();
                $totalApplications = Application::count();
                $approvedApplications = Application::where('status', 'approved')->count();
                $totalAmount = Scholarship::sum('amount');
                
                return view('admin.reports.overall', compact(
                    'totalStudents', 'totalReviewers', 'totalScholarships',
                    'totalApplications', 'approvedApplications', 'totalAmount'
                ));
        }
    }
}