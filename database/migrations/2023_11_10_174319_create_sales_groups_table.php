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
        Schema::create('sales_groups', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('manager');
            $table->unsignedBigInteger('agent_type_id')->nullable();
            $table->foreign('agent_type_id')->references('id')->on('agent_types')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('sales_groups');
    }
};
