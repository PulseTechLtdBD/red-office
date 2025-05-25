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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('spouse_name')->nullable();
            $table->foreignId('designation_id')->constrained();
            $table->foreignId('department_id')->constrained();
            $table->date('joined_at')->nullable();
            $table->string('employee_type')->default('fulltime');
            $table->date('date_of_birth');
            $table->string('gender')->default('male');
            $table->string('blood_group')->nullable();
            $table->string('national_id')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('driving_license_no')->nullable();
            $table->boolean('employee_status')->default(true);

            //additional info
            $table->string('marital_status')->nullable();
            $table->string('religion')->nullable();
            $table->string('nationality');
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_number');
            $table->string('profile_picture_src', 1024);
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
