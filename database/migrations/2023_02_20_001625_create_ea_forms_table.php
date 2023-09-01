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
        Schema::create('ea_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //foreign key
            $table->date('date')->nullable();
            $table->string('year')->nullable();
            $table->string('tax_num')->nullable();
            $table->string('payroll_num')->nullable();
            $table->string('epf_num')->nullable();
            $table->string('kwsp_num')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('children_num')->nullable();
            $table->decimal('gross_salary')->nullable();
            $table->decimal('fees')->nullable();
            $table->decimal('gross_tip')->nullable();
            $table->decimal('income_tax')->nullable();
            $table->decimal('refund')->nullable();
            $table->decimal('compensation')->nullable();
            $table->decimal('pension')->nullable();
            $table->decimal('annuities')->nullable();
            $table->decimal('tax_deduction')->nullable();
            $table->decimal('cp38_deduction')->nullable();
            $table->decimal('zakat_deduction')->nullable();
            $table->decimal('zakat')->nullable();
            $table->decimal('child_relief')->nullable();
            $table->decimal('amount')->nullable();
            $table->decimal('socso')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');//foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ea_forms');
    }
};
