<?php

namespace App\Http\Controllers\Reviewer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function evaluate($id)
    {
        if (auth()->user()->role !== 'reviewer') {
            abort(403);
        }
        
        $application = Application::where('reviewer_id', auth()->id())
                                  ->with(['student', 'scholarship'])
                                  ->findOrFail($id);
        
        return view('reviewer.evaluate-application', compact('application'));
    }
    
    public function storeScores(Request $request, $id)
    {
        if (auth()->user()->role !== 'reviewer') {
            abort(403);
        }
        
        $application = Application::where('reviewer_id', auth()->id())->findOrFail($id);
        
        $request->validate([
            'academic_score' => 'required|numeric|min:0|max:100',
            'personal_statement_score' => 'required|numeric|min:0|max:100',
            'extracurricular_score' => 'required|numeric|min:0|max:100',
            'recommendations_score' => 'required|numeric|min:0|max:100',
            'feedback' => 'nullable|string',
            'recommendation' => 'required|in:approve,reject',
        ]);
        
        $totalScore = ($request->academic_score * 0.4) +
                      ($request->personal_statement_score * 0.3) +
                      ($request->extracurricular_score * 0.2) +
                      ($request->recommendations_score * 0.1);
        
        $application->update([
            'academic_score' => $request->academic_score,
            'personal_statement_score' => $request->personal_statement_score,
            'extracurricular_score' => $request->extracurricular_score,
            'recommendations_score' => $request->recommendations_score,
            'score' => $totalScore,
            'feedback' => $request->feedback,
            'recommendation' => $request->recommendation,
            'status' => 'reviewed',
            'reviewed_date' => now(),
            'evaluated_at' => now(),
        ]);
        
        return redirect()->route('reviewer.evaluation.finalize', $application->id)
                         ->with('success', 'Evaluation saved successfully!');
    }
    
    public function finalize($id)
    {
        if (auth()->user()->role !== 'reviewer') {
            abort(403);
        }
        
        $application = Application::where('reviewer_id', auth()->id())
                                  ->with(['student', 'scholarship'])
                                  ->findOrFail($id);
        
        return view('reviewer.finalize-evaluation', compact('application'));
    }
    
    public function confirmSubmit($id)
    {
        if (auth()->user()->role !== 'reviewer') {
            abort(403);
        }
        
        $application = Application::where('reviewer_id', auth()->id())->findOrFail($id);
        
        if ($application->status !== 'reviewed') {
            $application->update([
                'status' => 'reviewed',
                'reviewed_date' => now(),
            ]);
        }
        
        return view('reviewer.submit-confirmation', compact('application'));
    }
}