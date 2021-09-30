<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeStoreRequest;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::with('department')->latest()->get();
        if ($request->search){
            $employees = Employee::where('first_name', "like", "%{$request->search}%")->orWhere('last_name', "like", "%{$request->search}%")->with('department')->latest()->get();
        }elseif ($request->department_id){
            $employees = Employee::where('department_id', $request->department_id)->with('department')->latest()->get();
        }
        return response()->json($employees);
    }

    public function store(EmployeeStoreRequest $request)
    {
        Employee::create(['birthdate' => Carbon::parse($request->birthdate), 'date_hired' => Carbon::parse($request->date_hired)] + $request->validated());
        return response()->json(['success' => true, 'message' => 'Employee added!']);
    }

    public function show(Employee $employee)
    {
        return response()->json($employee);
    }

    public function update(EmployeeStoreRequest $request, Employee $employee)
    {
        $employee->update(['birthdate' => Carbon::parse($request->birthdate), 'date_hired' => Carbon::parse($request->date_hired)] + $request->validated());
        return response()->json(['success' => true, 'message' => 'Employee updated!']);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json('Employee deleted!');
    }
}
