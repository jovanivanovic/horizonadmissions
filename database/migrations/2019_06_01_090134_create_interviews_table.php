<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('type_id')->index();
            $table->unsignedInteger('student_id')->index();
            $table->unique(['type_id', 'student_id']);

            $table->dateTime('datetime')->unique();

            $table->enum('status', ['pending', 'rejected', 'confirmed']);

            $table->foreign('type_id')->references('id')->on('interview_types')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interviews');
    }
}
