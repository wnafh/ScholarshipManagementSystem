<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    public function browse(Request $request)
    {
        if (auth()->user()->role !== 'student') {
            abort(403);
        }
        
        $query = Scholarship::where('status', 'published')
                            ->where('end_date', '>=', now());
        
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        $scholarships = $query->orderBy('end_date', 'asc')->get();
        
        return view('student.browse-scholarships', compact('scholarships'));
    }
    
    public function details($id)
    {
        if (auth()->user()->role !== 'student') {
            abort(403);
        }
        
        $scholarship = Scholarship::findOrFail($id);
        return view('student.scholarship-details', compact('scholarship'));
    }
}