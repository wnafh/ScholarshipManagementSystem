<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $query = Scholarship::query();
        
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
        }
        
        $scholarships = $query->orderBy('created_at', 'desc')->get();
        return view('admin.manage-scholarships', compact('scholarships'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        return view('admin.create-scholarship');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'description' => 'required|string',
            'status' => 'required|in:draft,published,closed',
        ]);
        
        $validated['requirements'] = json_encode(Scholarship::getDefaultRequirements());

        Scholarship::create($validated);

        return redirect()->route('admin.scholarships.index')
                         ->with('success', 'Scholarship created successfully!');
    }

    public function edit($id)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $scholarship = Scholarship::findOrFail($id);
        return view('admin.edit-scholarship', compact('scholarship'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $scholarship = Scholarship::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'description' => 'required|string',
            'status' => 'required|in:draft,published,closed',
        ]);
        
        if (!$scholarship->requirements) {
            $validated['requirements'] = json_encode(Scholarship::getDefaultRequirements());
        } else {
            $validated['requirements'] = $scholarship->requirements;
        }

        $scholarship->update($validated);

        return redirect()->route('admin.scholarships.index')
                         ->with('success', 'Scholarship updated successfully!');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $scholarship = Scholarship::findOrFail($id);
        $scholarship->delete();

        return redirect()->route('admin.scholarships.index')
                         ->with('success', 'Scholarship deleted successfully!');
    }
}