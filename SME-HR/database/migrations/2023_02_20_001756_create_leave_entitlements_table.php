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
        Schema::create('leave_entitlements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //foreign key
            $table->unsignedBigInteger('leave_type_id'); //foreign key
            $table->integer('leave_assign');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');//foreign key
            $table->foreign('leave_type_id')->references('id')->on('leave_types');//foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_entitlements');
    }
};
