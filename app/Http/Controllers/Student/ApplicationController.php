<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'student') {
            abort(403);
        }
        
        $applications = Application::where('student_id', auth()->id())
                                   ->with('scholarship')
                                   ->orderBy('created_at', 'desc')
                                   ->get();
        
        return view('student.my-applications', compact('applications'));
    }
    
    public function create($scholarshipId)
    {
        if (auth()->user()->role !== 'student') {
            abort(403);
        }
        
        $scholarship = Scholarship::findOrFail($scholarshipId);
        return view('student.apply-scholarship', compact('scholarship'));
    }
    
    public function store(Request $request, $scholarshipId)
    {
        if (auth()->user()->role !== 'student') {
            abort(403);
        }
        
        $request->validate([
            'personal_statement' => 'required|string|min:300',
            'transcript' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'recommendation_letter' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'supporting_documents' => 'nullable|array',
            'supporting_documents.*' => 'file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        
        $transcriptPath = $request->file('transcript')->store('applications/transcripts', 'public');
        $recommendationPath = $request->file('recommendation_letter')->store('applications/recommendations', 'public');
        
        // Handle multiple supporting documents
        $supportingDocsPaths = [];
        if ($request->hasFile('supporting_documents')) {
            foreach ($request->file('supporting_documents') as $doc) {
                $supportingDocsPaths[] = $doc->store('applications/supporting', 'public');
            }
        }
        
        Application::create([
            'student_id' => auth()->id(),
            'scholarship_id' => $scholarshipId,
            'personal_statement' => $request->personal_statement,
            'transcript_path' => $transcriptPath,
            'recommendation_letter_path' => $recommendationPath,
            'supporting_documents_path' => !empty($supportingDocsPaths) ? json_encode($supportingDocsPaths) : null,
            'status' => 'pending',
            'applied_date' => now(),
        ]);
        
        return redirect()->route('student.applications.index')
                         ->with('success', 'Application submitted successfully!');
    }
    
    public function show($id)
    {
        if (auth()->user()->role !== 'student') {
            abort(403);
        }
        
        $application = Application::where('student_id', auth()->id())
                                  ->with('scholarship')
                                  ->findOrFail($id);
        
        return view('student.application-details', compact('application'));
    }
}