<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class RoleSelectionController extends Controller
{
    public function show(): View
    {
        return view('public.choose-acc');
    }
}