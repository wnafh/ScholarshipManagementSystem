<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ReviewerProfile;
use Illuminate\Http\Request;

class ReviewerController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $query = User::where('role', 'reviewer');
        
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        $reviewers = $query->with('reviewerProfile')
                           ->orderBy('created_at', 'desc')
                           ->get();
        return view('admin.manage-reviewers', compact('reviewers'));
    }

    public function approve()
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $pendingReviewers = User::where('role', 'reviewer')
                                ->whereDoesntHave('reviewerProfile', function($query) {
                                    $query->where('status', 'approved');
                                })
                                ->get();
        return view('admin.approve-reviewers', compact('pendingReviewers'));
    }

    public function approveStore(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $user = User::where('role', 'reviewer')->findOrFail($id);
        
        $assignedCategories = $request->has('assigned_categories') 
            ? json_encode($request->assigned_categories) 
            : json_encode(['Merit Scholarship', 'Research Scholarship']);
        
        ReviewerProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'status' => 'approved',
                'approved_at' => now(),
                'assigned_categories' => $assignedCategories,
            ]
        );

        return redirect()->route('admin.reviewers.approve')
                         ->with('success', 'Reviewer approved successfully!');
    }

    public function reject($id)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $user = User::where('role', 'reviewer')->findOrFail($id);
        
        ReviewerProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'status' => 'rejected',
                'rejected_at' => now(),
            ]
        );

        return redirect()->route('admin.reviewers.approve')
                         ->with('success', 'Reviewer rejected successfully!');
    }

    public function edit($id)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $reviewer = User::where('role', 'reviewer')
                        ->with('reviewerProfile')
                        ->findOrFail($id);
        return view('admin.edit-reviewer', compact('reviewer'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $reviewer = User::where('role', 'reviewer')->findOrFail($id);
        
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $reviewer->update([
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
        ]);

        return redirect()->route('admin.reviewers.index')
                         ->with('success', 'Reviewer updated successfully!');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $reviewer = User::where('role', 'reviewer')->findOrFail($id);
        
        if ($reviewer->reviewerProfile) {
            $reviewer->reviewerProfile->delete();
        }
        $reviewer->delete();

        return redirect()->route('admin.reviewers.index')
                         ->with('success', 'Reviewer deleted successfully!');
    }
}