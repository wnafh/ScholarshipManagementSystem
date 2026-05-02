<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ProfileController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'student') {
            abort(403);
        }
        
        $user = auth()->user();
        return view('student.profile', compact('user'));
    }
    
    public function update(Request $request)
    {
        if (auth()->user()->role !== 'student') {
            abort(403);
        }
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);
        
        $user = auth()->user();
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->save();
        
        return redirect()->route('student.profile')
                         ->with('success', 'Profile updated successfully!');
    }
}