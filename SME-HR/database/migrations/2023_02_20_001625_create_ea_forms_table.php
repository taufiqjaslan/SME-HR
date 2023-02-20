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
            $table->string('lhdn_branch');
            $table->string('employer_name');
            $table->string('tax_num');
            $table->integer('year');
            $table->decimal('gross_salary');
            $table->string('income_type');
            $table->decimal('zakat')->nullable();
            $table->decimal('pension')->nullable();
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
