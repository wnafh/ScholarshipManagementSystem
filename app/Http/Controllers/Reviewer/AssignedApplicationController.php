<?php

namespace App\Http\Controllers\Reviewer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class AssignedApplicationController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role !== 'reviewer') {
            abort(403);
        }
        
        $query = Application::where('reviewer_id', auth()->id())
                            ->with(['student', 'scholarship']);
        
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('student', function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        $applications = $query->orderBy('created_at', 'desc')->get();
        
        return view('reviewer.assigned-applications', compact('applications'));
    }
    
    public function show($id)
    {
        if (auth()->user()->role !== 'reviewer') {
            abort(403);
        }
        
        $application = Application::where('reviewer_id', auth()->id())
                                  ->with(['student', 'scholarship'])
                                  ->findOrFail($id);
        
        return view('reviewer.view-application', compact('application'));
    }
}