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
            $table->decimal('kwsp_staff'); 
            $table->decimal('kwsp_company'); 
            $table->decimal('socso_staff');
            $table->decimal('socso_company'); 
            $table->decimal('eis_staff'); 
            $table->decimal('eis_company'); 
            $table->decimal('zakat')->nullable();
            $table->decimal('allowance')->nullable();
            $table->decimal('bonus')->nullable();
            $table->decimal('deduction')->nullable();
            $table->decimal('netpay')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');//foreign key
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
