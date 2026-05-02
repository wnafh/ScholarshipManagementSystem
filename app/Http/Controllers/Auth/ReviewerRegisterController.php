<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ReviewerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ReviewerRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register-reviewer');
    }

    public function register(Request $request)
    {
        // Validate the request
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'occupation' => 'required|string|max:255',
            'resume_path' => 'required|file|mimes:pdf,doc,docx|max:5120',
            'proof_of_expertise_path' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Store files
        $resumePath = $request->file('resume_path')->store('reviewer_documents/resumes', 'public');
        $proofPath = $request->file('proof_of_expertise_path')->store('reviewer_documents/proofs', 'public');

        // Create user with file paths
        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'reviewer',
            'occupation' => $request->occupation,
            'resume_path' => $resumePath,
            'proof_of_expertise_path' => $proofPath,
        ]);

        // Create reviewer profile
        ReviewerProfile::create([
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        return redirect()->route('login')->with('success', 'Registration submitted. Please wait for admin approval.');
    }
}