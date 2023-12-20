<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\GeneralActionRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get_all_departments()
    {
        try {
            $departments = Department::all();
            return response()->json(['status' => true, 'data' => $departments]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'errors' => ['No se logro obtener los departamentos', $th->getMessage()], 400]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = $request->user();
        //        
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:255|unique:departments',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }

        try {
            $department = Department::create([
                'description' => $request->description,
            ]);
            $GAC = GeneralActionRecord::create([
                'description' => "El usuario $user->first_name $user->lastname ($user->document)",
                'author' => 'SISGACI',
                'importante' => 'Alta',
            ]);
            $GAC->user()->associate($user);
            $GAC->save();
            return response()->json(['message' => 'Departamento creado exitosamente', 'data' => $department, 'status' => true]);
        } catch (\Throwable $th) {
            return response()->json(['errors' => ['No se logro crear el departamento', $th->getMessage()], 'status' => false], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        //
    }
}
