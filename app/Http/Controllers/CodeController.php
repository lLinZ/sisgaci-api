<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Http\Controllers\Controller;
use App\Models\GeneralActionRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CodeController extends Controller
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
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'description' => 'required|string|unique:codes',
            'letter' => 'required|string|unique:codes',
            'number' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }

        try {

            $code = Code::create([
                'letter' => $request->letter,
                'number' => $request->number,
                'description' => $request->description,
            ]);

            $G_A_C = GeneralActionRecord::create([
                'description' => "$user->first_name $user->lastname ($user->document) acaba de crear un nuevo tipo de correlativo ($code->letter) $code->description",
                'author' => 'SISGACI',
                'importance' => 'Alta'
            ]);

            $G_A_C->user()->associate($user);

            $G_A_C->save();
            return response()->json(['status' => true, 'message' => 'Se ha creado el codigo exitosamente']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'errors' => ['No se logro crear el codigo correlativo', $th->getMessage()]], 500);
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
    public function show(Code $code)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Code $code)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Code $code)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Code $code)
    {
        //
    }
}
