<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\SacComment;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $calls = Call::with('client')->paginate(20);
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
                    $user_name = "$user->first_name $user->lastname";
                    $client_name = "$client->first_name $client->lastname";
                    $comment = SacComment::create([
                        'description' => "$user_name registro una llamada y un cliente ($client_name)",
                        'author' => 'SISGACI'
                    ]);
                    $comment->call()->associate($call);
                    $comment->user()->associate($user);
                    $comment->save();

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
     * Agregar comentario a la llamada por su id
     */
    public function add_comment_to_call(Request $request, Call $call)
    {
        $validator = Validator::make($request->all(), [
            'feedback' => 'required|string'
        ], [
            'feedback.required' => 'El comentario es obligatorio',
            'feedback.string' => 'Tipo de comentario invalido, informele a sistemas sobre este codigo de error FEEDBACK_STRING'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }
        $user = $request->user();
        $comment = SacComment::create([
            'description' => $request->feedback,
            'author' => "$user->first_name $user->lastname",
        ]);
        $comment->call()->associate($call);
        $comment->user()->associate($user);
        $comment->save();
        $all_comments = SacComment::with('user')->where('call_id', $call->id)->orderBy('created_at', 'desc')->get();
        return response()->json(['status' => true, 'data' => $all_comments]);
    }
    public function get_call_by_phone(Request $request, $phone, $phone_alone)
    {
        $user = $request->user();
        $clients = Client::where('phone', $phone)->orWhere('phone', 'like', "%$phone_alone%")->get();
        // return response()->json(['status' => true, 'data' => $client]);
        if (isset($clients) > 0) {
            $data = [];
            $errors = [];
            foreach ($clients as $client) {
                try {
                    $call = Call::where('client_id', $client->id)->get()->first();
                    $call->client = $client;
                    $comment = SacComment::create([
                        'description' => "El usuario $user->first_name $user->lastname busco el siguiente numero: $phone",
                        'author' => 'SISGACI',
                    ]);
                    $comment->call()->associate($call);
                    $comment->user()->associate($user);
                    $comment->save();
                    $data[] = $call;
                } catch (\Throwable $th) {
                    $errors = ["Ocurrio un error al buscar la llamada del cliente con id $client->id", $th->getMessage(), $client];
                }
            }
            if (sizeof($data) == 0) {
                return response()->json(['status' => false, 'errors' => ['No se encontro el numero de telefono']], 404);
            }
            return response()->json(['status' => true, 'data' => $data, 'errors' => $errors]);
        } else {
            return response()->json(['status' => false, 'errors' => ['No se encontro el numero de telefono']], 404);
        }
    }
    /**
     * Obtener llamada por su id
     */
    public function get_call_by_id(Call $call)
    {
        try {
            $call_with_details = Call::with('client', 'status')->where('id', $call->id)->get()->first();
            $sac_comments = SacComment::with('user')->where('call_id', $call->id)->orderBy('created_at', 'desc')->get();
            return response()->json(['status' => true, 'data' => ['call' => $call_with_details, 'comments' => $sac_comments]]);
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
    // 
    // 
    // 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Call $call)
    {
        // $user  = $request->user();
        // if (intval($user->level) < 10) {
        //     return response()->json(['status' => false, 'message' => 'No tienes el nivel de acceso permitido para esta accion'], 401);
        // }
        $call_with_client = Call::with('client', 'status')->where('id', $call->id)->first();
        $client_id = $call_with_client->client->id;
        $call_id = $call->id;
        //
        try {
            DB::beginTransaction();
            $call_result = Call::destroy($call_id);
            if ($call_result) {
                $client_result = Client::destroy($client_id);
                if ($client_result) {
                    DB::commit();
                    return response()->json(['status' => true, 'message' => 'Se ha eliminado el cliente y la llamada']);
                } else {
                    DB::rollBack();
                    throw new \Exception('No se elimino la llamada ni el cliente' . $call_result . ' ' . $client_result);
                }
            } else {
                DB::rollBack();
                throw new \Exception('No se elimino la llamada');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => false, 'errors' => [$th->getMessage()]], 500);
        }
    }
}
