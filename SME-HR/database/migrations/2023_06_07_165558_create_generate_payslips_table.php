<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generate_payslips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //foreign key
            $table->decimal('basic_salary')->nullable(); 
            $table->decimal('kwsp_staff')->nullable(); 
            $table->decimal('kwsp_company')->nullable(); 
            $table->decimal('socso_staff')->nullable();
            $table->decimal('socso_company')->nullable(); 
            $table->decimal('eis_staff')->nullable();
            $table->decimal('eis_company')->nullable();
            $table->decimal('zakat')->nullable();
            $table->decimal('allowance')->nullable();
            $table->decimal('bonus')->nullable();
            $table->decimal('deduction')->nullable();
            $table->decimal('netpay')->nullable();
            $table->integer('year')->nullable();
            $table->integer('month')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');//foreign key
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('generate_payslips');
    }
};
