<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('question_id')->unsigned();
            $table->string('title');
            $table->boolean('is_correct');
            $table->timestamps();
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->foreign('question_id')
                ->references('id')
                ->on('questions')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answers', function(Blueprint $table) {

            $table->dropForeign('answers_question_id_foreign');
        });

        Schema::drop('answers');
    }
}
