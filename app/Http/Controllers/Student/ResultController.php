<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'student') {
            abort(403);
        }
        
        $results = Application::where('student_id', auth()->id())
                              ->whereIn('status', ['approved', 'rejected'])
                              ->with('scholarship')
                              ->orderBy('updated_at', 'desc')
                              ->get();
        
        return view('student.scholarship-results', compact('results'));
    }
}