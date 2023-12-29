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
            $table->string('code')->nullable();;
            $table->string('name')->nullable();
            $table->string('price')->nullable();
            $table->string('short_address')->nullable();
            $table->string('web_description')->nullable();
            $table->string('main_pic')->nullable();
            $table->unsignedBigInteger('property_type_id')->nullable();
            $table->foreign('property_type_id')->references('id')->on('property_types')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('property_transaction_type_id')->nullable();
            $table->foreign('property_transaction_type_id')->references('id')->on('property_transaction_types')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
