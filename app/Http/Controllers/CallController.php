<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class CallController extends Controller
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
        Client::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'lastname' => $request->lastname,
            'second_lastname' => $request->second_lastname,
            'nationality' => $request->nationality,
            'document' => $request->document,
            'phone' => $request->phone,
            'email' => $request->email,
            'marital_status' => $request->marital_status,
        ]);
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
    public function show(Call $call)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Call $call)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Call $call)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Call $call)
    {
        //
    }
}
