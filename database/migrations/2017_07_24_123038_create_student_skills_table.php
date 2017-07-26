<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_skills', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('skill_id');
            $table->unsignedInteger('level');
            $table->unsignedInteger('exp');
            $table->unsignedInteger('next_exp');
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
        Schema::dropIfExists('student_skills');
    }
}
