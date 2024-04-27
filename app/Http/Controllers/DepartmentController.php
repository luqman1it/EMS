<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        return response()->json([
            'status' => 'success',
            'department' => $departments
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request)
    {
        try {
            DB::beginTransaction();
            $request->rules();
            DB::commit();
            $department =  Department::create([
                'name' => $request->name,
                'description' => $request->description
            ]);
            return response()->json([
                'status' => 'success',
                'department' => $department
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
            return response()->json([
                'status' => 'failed',
                'message' => 'the department not created'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return response()->json([
            'status' => 'success',
            'department' => $department
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDepartmentRequest $request, Department $department)
    {
        $request->rules();
        $newData = $request->only(['name', 'description']);
        $department->update($newData);
        return response()->json([
            'status' => 'success',
            'department' => $department
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'department deleted successfully'
        ]);
    }
}
