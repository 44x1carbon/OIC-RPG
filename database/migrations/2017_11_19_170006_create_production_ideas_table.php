<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductionIdeasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_ideas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('production_idea_id');
            $table->string('production_theme')->nullable();
            $table->string('production_type_id')->nullable();
            $table->unsignedInteger('party_id')->nullable();
            $table->text('idea_description')->nullable();
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
        Schema::dropIfExists('production_ideas');
    }
}
