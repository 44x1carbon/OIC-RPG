<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartyParticipationRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('party_participation_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('party_participation_request_id');
            $table->string('party_id');
            $table->string('wanted_role_id');
            $table->string('guild_member_id');
            $table->date('application_date');
            $table->string('reply')->nullable();
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
        Schema::dropIfExists('party_participation_requests');
    }
}
