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
        Schema::create('franchises', function (Blueprint $table) {
            $table->id();
            $table->integer('franchise_number')->unique();
            $table->integer('current_owner_id')->nullable();
            $table->integer('operator_id')->nullable();
            $table->enum('status', [
                'available',
                'unavailable',
                'owned'
            ])->default('available');
            $table->string('vehicle_type');
            $table->date('date_issued')->nullable();
            $table->date('expiration_date')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('franchises');
    }
};
