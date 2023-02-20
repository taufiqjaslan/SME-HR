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
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //foreign key
            $table->unsignedBigInteger('claim_type_id'); //foreign key
            $table->string('subject');
            $table->date('date');
            $table->decimal('amount');
            $table->string('attachment');
            $table->integer('status');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');//foreign key
            $table->foreign('claim_type_id')->references('id')->on('claim_types');//foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
