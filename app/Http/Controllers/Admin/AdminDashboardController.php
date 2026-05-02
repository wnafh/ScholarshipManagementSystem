<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Application;
use App\Models\Scholarship;

class AdminDashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access. Admin only.');
        }
        
        $totalStudents = User::where('role', 'student')->count();
        $totalReviews = Application::whereIn('status', ['reviewed', 'approved', 'rejected'])->count();
        $totalApplications = Application::count();
        
        $recentApplications = Application::with(['student', 'scholarship'])
                                        ->latest()
                                        ->take(5)
                                        ->get();
        
        $pendingReviews = Application::where('status', 'pending')->count();
        $pendingReviewers = User::where('role', 'reviewer')
                                ->whereDoesntHave('reviewerProfile', function($query) {
                                    $query->where('status', 'approved');
                                })
                                ->count();

        return view('admin.dashboard', compact(
            'totalStudents', 
            'totalReviews', 
            'totalApplications',
            'recentApplications',
            'pendingReviews',
            'pendingReviewers'
        ));
    }
}