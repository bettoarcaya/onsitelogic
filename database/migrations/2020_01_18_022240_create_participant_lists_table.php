<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('participant_id');
            $table->unsignedBigInteger('event_id');
            $table->timestamps();

            $table->foreign('participant_id')
                  ->references('id')
                  ->on('participants');
            $table->foreign('event_id')
                  ->references('id')
                  ->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participant_lists');
    }
}
