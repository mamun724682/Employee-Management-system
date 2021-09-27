<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::orderBy('name')->paginate();
        if (\request()->search){
            $search = request()->search;
            $departments = Department::where('name', 'like', "%{$search}%")->latest()->paginate();
        }

        return view('departments.index', compact('departments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:departments'
        ]);

        Department::create($data);

        return back()->with('message', 'Department Added!');
    }

    public function update(Request $request, Department $department)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:departments,name,'.$department->id
        ]);

        $department->update($data);

        return back()->with('message', 'Department Updated!');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return back()->with('message', 'Department deleted!');
    }
}
