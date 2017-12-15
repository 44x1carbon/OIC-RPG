<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWantedRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wanted_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('wanted_role_id');
            $table->string('role_name');
            $table->text('remarks')->nullable();
            $table->string('reference_job_id')->nullable();
            $table->unsignedInteger('party_id');
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
        Schema::dropIfExists('wanted_roles');
    }
}
