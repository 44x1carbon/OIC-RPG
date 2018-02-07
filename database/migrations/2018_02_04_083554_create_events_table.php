<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('event_id');
            $table->string('name');
            $table->string('theme');
            $table->text('description');
            $table->date('release_start_date');
            $table->date('release_end_date');
            $table->date('event_hold_start_date');
            $table->date('event_hold_end_date');
            $table->date('evaluation_start_date');
            $table->date('evaluation_end_date');
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
        Schema::dropIfExists('events');
    }
}
