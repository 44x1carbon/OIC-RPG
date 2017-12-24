<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWantedMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wanted_members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('wanted_status');
            $table->string('wanted_member_id');
            $table->unsignedInteger('wanted_role_id');
            $table->string('officer_id')->nullable();
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
        Schema::dropIfExists('wanted_members');
    }
}
