<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->nullable();;
            $table->string('phone_number')->nullable();;
            $table->string('email')->unique();
            $table->string('password');
            $table->string('address')->nullable();;
            $table->string('gender')->nullable();;
            $table->date('start_date')->nullable();;
            $table->date('end_date')->nullable();;
            $table->unsignedBigInteger('position_id')->nullable();; //foreign key
            $table->unsignedBigInteger('user_type_id')->nullable();; //foreign key
            $table->integer('status')->nullable();;
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->timestamps();
            // $table->foreign('position_id')->references('id')->on('positions');//foreign key
            // $table->foreign('user_type_id')->references('id')->on('user_types');//foreign key
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
