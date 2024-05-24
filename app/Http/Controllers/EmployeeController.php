<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with('employee_factory')->paginate(10);
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $factories = Factory::all();

        return view('employee.create', compact('factories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $insert = Employee::firstOrCreate(['first_name' => $request->first_name, 'last_name' => $request->last_name], $request->validated());

        if ($insert->wasRecentlyCreated) {
            return back()->with(['status' => 'success', 'alert-class' => 'border-green-700 text-green-600', 'message' => 'Employee sucessfully added!']);
        }

        return back()->with(['status' => 'error','alert-class' => 'border-red-700 text-red-600', 'message' => 'Duplicate entry, employee already exists!'])->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        try {
            $factories = Factory::all();

            return view('employee.edit', compact('employee', 'factories'));
            
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('factory.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());

        return back()->with(['status' => 'success', 'alert-class' => 'border-green-700 text-green-600', 'message' => 'Employee sucessfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
 
            return back()->with(['status' => 'success', 'alert-class' => 'border-green-700 text-green-600', 'message' => 'Employee sucessfully deleted!']);
             
         } catch (ModelNotFoundException $exception) {
             return redirect()->route('employee.index');
         }
    }
}
