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
        Schema::create('paychecks', function (Blueprint $table) {
            $table->id();
            $table->string('period');
            $table->string('NIK');
            $table->foreign('NIK')->references('NIK')->on('employees');
            $table->integer('total_attendance');
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('incentive', 10, 2);
            $table->decimal('insurance_deduction', 10, 2);
            $table->decimal('total_salary', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paychecks');
    }
};
