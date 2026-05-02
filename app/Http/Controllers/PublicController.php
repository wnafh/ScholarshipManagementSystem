<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        return view('public.home');
    }

    public function about()
    {
        return view('public.about');
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function chooseAcc()
    {
        return view('public.choose-acc');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function studentSignup()
    {
        return view('auth.register-student'); 
    }

    public function reviewerSignup()
    {
        return view('auth.register-reviewer');  
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string|min:10',
        ]);
        
        
        
        return redirect()->route('contact')->with('success', 'Your message has been sent. We will respond within 24 hours.');
    }
}