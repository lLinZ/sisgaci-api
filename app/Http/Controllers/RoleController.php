<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\GeneralActionRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|unique:roles'
        ]);
        $user  = $request->user();
        if ($validator->fails()) {
            return response()->json(['status' => true, 'errors' => $validator->errors()], 400);
        }
        try {
            $role = Role::create([
                'description' => $request->description
            ]);
            $G_A_C = GeneralActionRecord::create([
                'description' => "El usuario $user->first_name $user->lastname, $user->document ha creado un nuevo rol $role->description",
                'author' => 'SISGACI',
                'importance' => 'Mediana',
            ]);
            $G_A_C->user()->associate($user);
            $G_A_C->save();
            return response()->json(['status' => true, 'message' => 'Se ha creado el rol exitosamente']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => false, 'errors' => ['No se logro crear el rol', $th->getMessage()]], 500);
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
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
