<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcquisitionCharacteristic extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'floor_number', // Numero de piso
        'antiquity', // Antigüedad
        'air_conditining', // Aire acondicionado
        'max_height', // Altura maxima
        'balcony', // Balcon
        'construction_meters', // Metraje de construccion
        'land_meters', // Metraje de terreno
        'ground_floor_meters', // Metraje de planta baja
        'mezzanine_meters', // Metraje de mezzanina
        'slope_meters', // Metraje de declive
        'flat_meters', // Metraje de plana
        'bedrooms', // Habitaciones
        'service_room', // Habitacion de servicio
        'bathrooms', // Baños
        'floor_quantity', // Cantidad de pisos
        'sewers', // Cloacas
        'fitted_kitchen', // Cocina empotrada
        'divisions', // Divisiones
        'hall', // Hall
        'jacuzzi', // Jacuzzi
        'laundry', // Laundry
        'levels', // Niveles
        'office', // Oficina
        'pantry', // Pantry
        'pool', // Piscina
        'floors', // Pisos
        'living_room', // Sala de estar
        'studio', // Estudio
        'water_tank', // Tanque de agua
        'tavern', // Tasca
        'phone', // Telefono
        'terrace', // Terraza
        'commercial', // Comercial
        'industrial', // Industrial
        'single_familiar', // Unifamiliar
        'multi_familiar', // Multifamiliar
        'zoning_type', // Tipo de zona
        'electric_current_type', // Tipo de corriente
        'doors_type', // Tipo de puertas
        'floor_type', // Tipo de piso
        'roof_type', // Tipo de techo
        'construction_percentaje', // Porcentaje de construccion
        'ubication_percentaje', // Porcentaje de ubicacion
        'surveillance', // Vigilancia
        'road', // Vialidad
        'parking_lot_quantity', // Cantidad de estacionamientos
        'parking_lot_details', // Detalle de estacionamientos
        'project', // Proyecto
        'others', // Otros
    ];
}
