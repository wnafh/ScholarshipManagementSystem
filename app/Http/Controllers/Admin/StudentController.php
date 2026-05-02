<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $query = User::where('role', 'student');
        
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        $students = $query->orderBy('created_at', 'desc')->get();
        return view('admin.manage-students', compact('students'));
    }

    public function edit($id)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $student = User::where('role', 'student')->findOrFail($id);
        return view('admin.edit-student', compact('student'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $student = User::where('role', 'student')->findOrFail($id);
        
        // Keep as is - the migration adds the status column
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'education_level' => 'nullable|string',
            'status' => 'required|in:active,suspended,inactive', // This will work after migration
        ]);

        $student->update($validated);

        return redirect()->route('admin.students.index')
                         ->with('success', 'Student updated successfully!');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $student = User::where('role', 'student')->findOrFail($id);
        $student->delete();

        return redirect()->route('admin.students.index')
                         ->with('success', 'Student deleted successfully!');
    }
}