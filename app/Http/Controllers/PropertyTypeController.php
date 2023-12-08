<?php

namespace App\Http\Controllers;

use App\Models\PropertyType;
use App\Http\Controllers\Controller;
use App\Models\GeneralActionRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PropertyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $property_types = PropertyType::all();
            return response()->json(['status' => true, 'data' => $property_types]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'errors' => [$th->getMessage()]], 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|unique:property_types',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }
        try {
            $property_type = PropertyType::create([
                'description' => $request->description,
            ]);

            $G_A_C = GeneralActionRecord::create([
                'description' => "El usuario $user->first_name $user->lastname acaba de registrar un nuevo tipo de inmueble: $request->description",
                'author' => "SISGACI",
                'importance' => 'Alta',
            ]);

            $G_A_C->user()->associate($user);

            return response()->json(['status' => true, 'data' => $property_type]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'errors' => ['No se logro registrar el tipo de propiedad', $th->getMessage()]], 500);
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
    public function show(PropertyType $propertyType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PropertyType $propertyType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PropertyType $propertyType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PropertyType $propertyType)
    {
        //
    }
}
