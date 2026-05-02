<?php

namespace App\Http\Controllers\Reviewer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ReviewerProfileController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'reviewer') {
            abort(403);
        }
        
        $user = auth()->user();
        return view('reviewer.profile', compact('user'));
    }
    
    public function update(Request $request)
    {
        if (auth()->user()->role !== 'reviewer') {
            abort(403);
        }
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string',
            'position' => 'nullable|string',
        ]);
        
        $user = auth()->user();
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->occupation = $request->position;
        $user->save();
        
        return redirect()->route('reviewer.profile')
                         ->with('success', 'Profile updated successfully!');
    }
}