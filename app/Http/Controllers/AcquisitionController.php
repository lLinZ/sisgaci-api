<?php

namespace App\Http\Controllers;

use App\Models\Acquisition;
use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\GeneralActionRecord;
use App\Models\PropertyTransactionType;
use App\Models\PropertyType;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AcquisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function my_acquisitions(Request $request)
    {
        //
        $user = $request->user();

        try {
            $acquisitions = Acquisition::with('status', 'property_type', 'property_transaction_type', 'user')->where('user_id', $user->id)->paginate();
            return response()->json(['status' => true, 'data' => $acquisitions]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => false, 'errors' => ['No se logro conectar a la BD', $th->getMessage()]], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Datos del usuario loggeado
        $user = $request->user();

        // Validacion de datos
        $validator = Validator::make($request->all(), [
            'price' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'short_address' => 'required|string|max:255',
            'web_description' => 'required|string|max:255',
        ]);
        // Si existe imagen se procede a guardarla en la direcicon correspondiente
        if ($request->has('image')) {
        } else {
            return response()->json(['status' => false, 'errors' => ['La imagen es obligatoria']], 400);
        }
        // Validacion de errores
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }
        try {

            // Se obtiene el tipo de transacion de propiedad
            $property_transaction_type = PropertyTransactionType::where('id', $request->property_transaction_type)->first();

            // Se obtiene el tipo de propiedad
            $property_type = PropertyType::where('id', $request->property_type)->first();

            $letter = '';

            // Segun el tipo de inmueble se obtiene la letra correspondiente para luego obtener el numero correlativo
            switch ($property_type->description) {
                case 'Quinta':
                    $letter = 'Q';
                    break;
                case 'Apartamento':
                    $letter = 'A';
                    break;
                case 'Local':
                    $letter = 'L';
                    break;
                case 'Terreno':
                    $letter = 'T';
                    break;
                case 'Oficina':
                    $letter = 'O';
                    break;
                case 'Galpon':
                    $letter = 'G';
                    break;
                case 'Parcela':
                    $letter = 'P';
                    break;
            }

            // Empieza la transaccion SQL
            DB::beginTransaction();

            // Se obtiene el correlativo segun el tipo de inmueble
            $code = Code::where('letter', $letter)->first();
            $code_assign = $code->number == 0 ? "$code->letter" . "1" : "$code->letter$code->number";
            // Se crea la captacion
            $acquisition = Acquisition::create([
                'name' => $request->name,
                'price' => $request->price,
                'short_address' => $request->short_address,
                'web_description' => $request->web_description,
                'code' => $code_assign
            ]);
            // Se obtiene el status activo y si no existe, se crea y se asocia a la captacion
            $status = Status::firstOrCreate(['description' => 'Activo']);
            $acquisition->status()->associate($status);
            $acquisition->user()->associate($user);
            $acquisition->property_transaction_type()->associate($property_transaction_type);
            $acquisition->property_type()->associate($property_type);


            // Se aumenta 1 unidad en el correlativo correspondiente
            $code->number = $code->number == 0 ? 2 : $code->number + 1;
            $code->save();

            if (is_dir(public_path("assets/images/acquisitions/$code_assign"))) {
                $image = $request->image;
                $image_name = md5(time() . rand()) . '.' . $image->getClientOriginalExtension();
                $path = public_path("assets/images/acquisitions/$code_assign");
                $image->move($path, $image_name);
            } else {
                mkdir(public_path("assets/images/acquisitions/$code_assign"), 0777);
                $image = $request->image;
                $image_name = md5(time() . rand()) . '.' . $image->getClientOriginalExtension();
                $path = public_path("assets/images/acquisitions/$code_assign");
                $image->move($path, $image_name);
            }

            $acquisition->main_pic = $image_name;
            $acquisition->save();

            // Al ocurrir un error con la Captacion, se hace rollback
            if (!$acquisition || !$property_transaction_type || !$property_type || !$code || !$status) {
                DB::rollBack();
                throw new \Exception('No se logro crear la Captacion');
            }
            // Crear registro en el historial de acciones generales
            $G_A_C = GeneralActionRecord::create([
                'description' => "El usuario $user->first_name $user->lastname acaba de registrar un nuevo tipo de inmueble: $request->name, con codigo: $code_assign",
                'author' => 'SISGACI',
                'importance' => 'Alta',
            ]);
            $G_A_C->user()->associate($user);

            // Se hace commit de los datos a la BD
            DB::commit();
            return response()->json(['status' => true, 'message' => "Se ha registrado al captacion exitosamente ($code_assign)"]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'errors' => ['No se logro crear la Captacion', $th->getMessage()]], 400);
        }
    }

    public function get_acquisition_by_id(Request $request, Acquisition $acquisition)
    {
        //
        if (isset($acquisition)) {
            $full_acquisition = Acquisition::with('property_type', 'property_transaction_type', 'status')->where('id', $acquisition->id)->first();
            return response()->json(['status' => true, 'data' => $full_acquisition, 'message' => 'Ok']);
        } else {
            return response()->json(['status' => false, 'message' => 'No se encontro'], 404);
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
    public function show(Acquisition $acquisition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Acquisition $acquisition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Acquisition $acquisition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Acquisition $acquisition)
    {
        //
    }
}
