<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Controllers\Controller;
use App\Models\ClientAditionalDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $clients = Client::with('status')->whereHas('status', function ($query) {
            $query->where(['description' => 'Activo']);
        })->get();
        return response()->json(['status' => true, 'data' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add_aditional_info(Request $request, Client $client)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'data' => 'required|string|unique:client_aditional_details',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }
        try {
            $client_detail = ClientAditionalDetail::create([
                'type' => $request->type,
                'data' => $request->data,
            ]);
            $client_detail->client()->associate($client);
            $client_detail->save();
            $details = ClientAditionalDetail::where('client_id', $client->id)->get();
            return response()->json(['status' => true, 'data' => $details]);
        } catch (\Throwable $th) {
            return response()->json(['status' => true, 'errors' => [[['No se logro crear el cliente']], [[$th->getMessage()]]]], 400);
        }
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
