<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsQuestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_question', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ms_question_type_id');
            $table->integer('ms_answer_type_id');
            $table->text('title');
            $table->string('image_path')->nullable();
            $table->integer('question_level_id');
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
        //
    }
}
