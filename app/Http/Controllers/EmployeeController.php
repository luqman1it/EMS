<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee = Employee::all();
        return response()->json([
            'status' => "sucess",
            'employees' => $employee
        ]);
    }
    public function getEmployeesWithDepartments()
    {
        $employees = Employee::with('department')->get();
        return $employees;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        try {
            DB::beginTransaction();
            $request->rules();
            DB::commit();
            $employee = Employee::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'department_id' => $request->department_id
            ]);
            return response()->json([
                'status' => 'sucess',
                'employees' => $employee
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th);
            return response()->json([
                'status' => 'failed',
                'message' => 'the Employee not created'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $employee = Employee::all();
        return response()->json([
            'status' => 'success',
            'employee' => $employee,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255'
        ]);
        $newData = [];
        if (isset($request->name)) {
            $newData['name'] = $request->name;
        }
        if (isset($request->email)) {
            $newData = $request->email;
        }
        $employee->update($newData);
        return response()->json([
            'status' => 'success',
            'employee' => $employee
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {

        $employee->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'employee deleted successfully'
        ]);
    }
}
