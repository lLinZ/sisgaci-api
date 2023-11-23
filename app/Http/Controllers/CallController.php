<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\SacComment;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $calls = Call::with('client')->get();
        return response()->json(['status' => true, 'data' => $calls]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            //datos de cliente
            'first_name' => 'required|string|max:255',
            'middle_name' => 'max:255',
            'lastname' => 'required|string|max:255',
            'second_lastname' => 'max:255',
            'phone' => 'required|string|max:255|unique:users|unique:clients',
            'email' => 'string|email|max:255|unique:clients',
            'document' => 'string|max:20|unique:users|unique:clients',
            'gender' => 'required|string',
            //datos de llamada
            'call_purpose' => 'required|string',
            'origin' => 'required|string',
            'zone' => 'required|string',
            'feedback' => 'required|string',
            'property_type' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }
        try {
            $client = Client::create([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'lastname' => $request->lastname,
                'second_lastname' => $request->second_lastname,
                'nationality' => $request->nationality,
                'document' => $request->document,
                'phone' => $request->phone,
                'email' => $request->email,
                'marital_status' => $request->marital_status,
                'gender' => $request->gender,
                'origin' => $request->origin,
            ]);
            // Obtener status activo o crear status si no existe
            $status = Status::firstOrNew(['description' => 'Activo']);
            $client->status()->associate($status);
            $client->save();
            try {
                $call = Call::create([
                    'origin' => $request->origin,
                    'zone' => $request->zone,
                    'call_purpose' => $request->call_purpose,
                    'property' => $request->property,
                    'property_type' => $request->property_type,
                    'feedback' => $request->feedback,
                ]);
                $status = Status::firstOrNew(['description' => 'Activo']);
                $call->status()->associate($status);
                $call->client()->associate($client);
                $call->save();
                try {
                    $user = $request->user();
                    $user_name = $user->first_name;
                    $client_name = $client->first_name;
                    $comment = SacComment::create([
                        'description' => "$user_name registro una llamada y un cliente ($client_name)",
                        'author' => 'SISGACI'
                    ]);
                    $comment->call()->associate($call);
                    $comment->user()->associate($user);
                    return response()->json(['status' => true, 'data' => ['call' => $call, 'client' => $client]]);
                } catch (\Throwable $th) {
                    //throw $th;
                    return response()->json(['status' => false, 'errors' => ['No se logro registrar el historial', $th->getMessage()]], 400);
                }
            } catch (\Throwable $th) {
                return response()->json(['status' => false, 'errors' => ['No se logro registrar la llamada', $th->getMessage()]], 400);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => false, 'errors' => ['No se logro registrar ni el cliente ni la llamada', $th->getMessage()]], 400);
        }
    }

    /**
     * Obtener llamada por su id
     */
    public function get_call_by_id(Call $call)
    {
        try {
            $call_with_details = Call::with('client', 'status')->where('id', $call->id)->get()->first();
            return response()->json(['status' => true, 'data' => $call_with_details]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'errors' => ['Ocurrio un error al buscar la informacion de la llamada', $th->getMessage()]], 400);
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
