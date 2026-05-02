<?php

namespace App\Http\Controllers\Reviewer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class ReviewerDashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'reviewer') {
            abort(403, 'Unauthorized access.');
        }
        
        $reviewerId = auth()->id();
        
        $totalAssigned = Application::where('reviewer_id', $reviewerId)->count();
        $pendingReviews = Application::where('reviewer_id', $reviewerId)
                                     ->where('status', 'assigned')
                                     ->count();
        $completedReviews = Application::where('reviewer_id', $reviewerId)
                                       ->where('status', 'reviewed')
                                       ->count();
        
        $recentApplications = Application::where('reviewer_id', $reviewerId)
                                         ->with(['student', 'scholarship'])
                                         ->orderBy('created_at', 'desc')
                                         ->take(5)
                                         ->get();
        
        return view('reviewer.dashboard', compact(
            'totalAssigned',
            'pendingReviews',
            'completedReviews',
            'recentApplications'
        ));
    }
}