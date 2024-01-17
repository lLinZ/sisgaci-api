<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('acquisition_characteristics', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('acquisition_id')->nullable();
            $table->foreign('acquisition_id')->references('id')->on('acquisitions')->onUpdate('cascade')->onDelete('cascade');
            $table->string('floor_number')->nullable();
            $table->string('antiquity')->nullable();
            $table->string('air_conditining')->nullable();
            $table->string('max_height')->nullable();
            $table->tinyInteger('balcony')->nullable();
            $table->string('construction_meters')->nullable();
            $table->string('land_meters')->nullable();
            $table->string('ground_floor_meters')->nullable();
            $table->string('mezzanine_meters')->nullable();
            $table->string('slope_meters')->nullable();
            $table->string('flat_meters')->nullable();
            $table->string('bedrooms')->nullable();
            $table->tinyInteger('service_room')->nullable();
            $table->string('bathrooms')->nullable();
            $table->string('floor_quantity')->nullable();
            $table->tinyInteger('sewers')->nullable();
            $table->string('fitted_kitchen')->nullable();
            $table->tinyInteger('divisions')->nullable();
            $table->tinyInteger('hall')->nullable();
            $table->tinyInteger('jacuzzi')->nullable();
            $table->tinyInteger('laundry')->nullable();
            $table->tinyInteger('levels')->nullable();
            $table->tinyInteger('office')->nullable();
            $table->tinyInteger('pantry')->nullable();
            $table->tinyInteger('pool')->nullable();
            $table->tinyInteger('floors')->nullable();
            $table->tinyInteger('living_room')->nullable();
            $table->tinyInteger('studio')->nullable();
            $table->tinyInteger('water_tank')->nullable();
            $table->tinyInteger('tavern')->nullable();
            $table->tinyInteger('phone')->nullable();
            $table->tinyInteger('terrace')->nullable();
            $table->tinyInteger('commercial')->nullable();
            $table->tinyInteger('industrial')->nullable();
            $table->tinyInteger('single_familiar')->nullable();
            $table->tinyInteger('multi_familiar')->nullable();
            $table->string('zoning_type')->nullable();
            $table->string('electric_current_type')->nullable();
            $table->string('doors_type')->nullable();
            $table->string('floor_type')->nullable();
            $table->string('roof_type')->nullable();
            $table->string('construction_percentaje')->nullable();
            $table->string('ubication_percentaje')->nullable();
            $table->tinyInteger('surveillance')->nullable();
            $table->tinyInteger('road')->nullable();
            $table->tinyInteger('parking_lot_quantity')->nullable();
            $table->tinyInteger('parking_lot_details')->nullable();
            $table->tinyInteger('project')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('status')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acquisition_characteristics');
    }
};
