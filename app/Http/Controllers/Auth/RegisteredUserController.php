<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     event(new Registered($user));

    //     Auth::login($user);

    //     return redirect(route('dashboard', absolute: false));
    // }
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:student,reviewer'],
        ];
        
        if ($request->role === 'student') {
            $rules['education_level'] = ['required', 'string'];
        }
        
        if ($request->role === 'reviewer') {
            $rules['occupation'] = ['required', 'string'];
            $rules['resume_path'] = ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'];
            $rules['proof_of_expertise_path'] = ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'];
        }
        
        $request->validate($rules);
        
        $resumePath = null;
        $proofPath = null;
        
        if ($request->role === 'reviewer') {
            if ($request->hasFile('resume_path')) {
                $resumePath = $request->file('resume_path')->store('reviewers/resumes', 'public');
            }
            if ($request->hasFile('proof_of_expertise_path')) {
                $proofPath = $request->file('proof_of_expertise_path')->store('reviewers/proofs', 'public');
            }
        }
        
        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'education_level' => $request->education_level,
            'occupation' => $request->occupation,
            'resume_path' => $resumePath,
            'proof_of_expertise_path' => $proofPath,
        ]);

        event(new Registered($user));
        Auth::login($user);

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'student') {
            return redirect()->route('student.dashboard');
        } elseif ($user->role === 'reviewer') {
            return redirect()->route('reviewer.dashboard');
        }

        return redirect()->route('dashboard');
    }
}
