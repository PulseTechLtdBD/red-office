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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('street_address');
            $table->string('apartment_address');
            $table->foreignId('area_id')->constrained('areas');
            $table->integer('zip_code');
            $table->string('latitude');
            $table->string('longitude');
            $table->boolean('is_primary');
            $table->string('contact_name');
            $table->string('contact_phone');
            $table->morphs('addressable');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
