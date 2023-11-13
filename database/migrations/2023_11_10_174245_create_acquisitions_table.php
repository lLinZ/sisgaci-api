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
        Schema::create('acquisitions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('price');
            $table->string('short_address')->nullable();
            $table->unsignedBigInteger('property_type')->nullable();
            $table->foreign('property_type')->references('id')->on('property_types')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('property_transaction_type')->nullable();
            $table->foreign('property_transaction_type')->references('id')->on('property_transaction_types')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('statuses')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acquisitions');
    }
};
