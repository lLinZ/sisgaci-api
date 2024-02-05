<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcquisitionInformation extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'building', // Edificio
        'floor', // Piso
        'apartment', // Apartamento
        'tower', // Torre
        'house_number', // Numero de casa
        'shed_number', // Numero de galpon
        'office_number', // Numero de oficina
        'mall', // Centro comercial
        'land', // Terreno
        'shed', // Galpon
        'lot', // Parcela
        'urbanization', // Urbanizacion
        'zone', // Zona
        'address', // Direccion
        'landmark', // Punto de referencia
        'surveilled_street', // Calle con vigilancia
        'residential', // Conjunto residencial
    ];
}
