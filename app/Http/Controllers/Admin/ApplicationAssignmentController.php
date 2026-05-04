<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;

class ApplicationAssignmentController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        
        $query = Application::with(['student', 'scholarship', 'reviewer']);
        
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('student', function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
            })->orWhereHas('scholarship', function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            });
        }
        
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }
        
        $applications = $query->orderBy('created_at', 'desc')->get();
        
        return view('admin.manage-applications', compact('applications'));
    }
    
    public function assign($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        
        $application = Application::with(['student', 'scholarship'])->findOrFail($id);
        
        $reviewers = User::where('role', 'reviewer')
                         ->whereHas('reviewerProfile', function($query) {
                             $query->where('status', 'approved');
                         })
                         ->get();
        
        return view('admin.assign-reviewer', compact('application', 'reviewers'));
    }
    
    public function assignReviewer(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        
        $request->validate([
            'reviewer_id' => 'required|exists:users,id',
        ]);
        
        $application = Application::findOrFail($id);
        
        $application->update([
            'reviewer_id' => $request->reviewer_id,
            'status' => 'assigned',
        ]);
        
        return redirect()->route('admin.applications.index')
                         ->with('success', 'Reviewer assigned successfully!');
    }
    
    public function approve($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        
        $application = Application::findOrFail($id);
        
        $application->update([
            'status' => 'approved',
        ]);
        
        return redirect()->route('admin.applications.index')
                         ->with('success', 'Application approved successfully!');
    }
    
    public function reject($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        
        $application = Application::findOrFail($id);
        
        $application->update([
            'status' => 'rejected',
        ]);
        
        return redirect()->route('admin.applications.index')
                         ->with('success', 'Application rejected successfully!');
    }
    
    public function show($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        
        $application = Application::with(['student', 'scholarship', 'reviewer'])->findOrFail($id);
        
        return view('admin.view-application', compact('application'));
    }
}