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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //foreign key
            $table->unsignedBigInteger('salary_type_id'); //foreign key
            $table->decimal('kwsp_staff'); 
            $table->decimal('socso_staff');
            $table->decimal('zakat');
            $table->decimal('deduction');
            $table->decimal('netpay');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');//foreign key
            $table->foreign('salary_type_id')->references('id')->on('salaries');//foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
