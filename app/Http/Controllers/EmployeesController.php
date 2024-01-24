<?php

namespace App\Http\Controllers;

use App\Http\Requests\employees\store;
use App\Http\Requests\employees\update;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $employees = Employee::latest()
            ->paginate($perPage);

        return inertia("Employees/Index", [
            "employees" => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Employees/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(store $request)
    {
        $data = $request->validated();
        Employee::create($data);

        return redirect(route('employees-master.index'))->with([
            'message' => 'Data Successfully Created!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return inertia('Employees/Edit', [
            'employee' => $employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(update $request, Employee $employee)
    {
        $employee->update($request->all());

        return redirect(route('employees-master.index'))->with([
            'message' => 'Data Successfully Created!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect(route('employees-master.index'))->with([
            'message' => 'data deleted!'
        ]);
    }
}
