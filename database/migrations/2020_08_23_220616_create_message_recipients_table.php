<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_recipients', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('message_id')->unsigned();
            $table->foreign('message_id')->references('id')
                ->on('messages')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('mes_rec_id');
            $table->string('mes_rec_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message_recipients');
    }
}
