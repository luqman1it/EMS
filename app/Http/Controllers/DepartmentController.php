<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Models\Departments;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $department = Departments::all();
        return response()->json([
            'status' => 'success',
            'department' => $department
        ]);
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
    public function store(StoreDepartmentRequest $request)
    {
        try {
            DB::beginTransaction();
            $request->rules();
            DB::commit();
            $department =  Departments::create([
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
    public function show(Departments $department)
    {
        $department = Departments::all();

        return response()->json([
            'status' => 'success',
            'department' => $department
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departments $departments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDepartmentRequest $request, Departments $departments)
    {
        $request->rules();
        $newData = [];
        if (isset($request->name)) {
            $newData['name'] = $request->name;
        }
        if (isset($request->description)) {
            $newData['description'] = $request->description;
        }
        $departments->update($newData);
        return response()->json([
            'status' => 'success',
            'employee' => $departments
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departments $department)
    {
        $department->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'department deleted successfully'
        ]);
    }
}
