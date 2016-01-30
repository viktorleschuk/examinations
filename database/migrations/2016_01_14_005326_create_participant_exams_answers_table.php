<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantExamsAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_exams_answers', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('participant_exam_id')
                ->unsigned();
            $table->integer('question_id')
                ->unsigned();
            $table->integer('answer_id')
                ->unsigned()
                ->nullable();
            $table->text('answer_body')
                ->nullable();
            $table->integer('elapsed_time');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('participant_exams_answers', function (Blueprint $table) {
            $table->foreign('participant_exam_id')
                ->references('id')
                ->on('participant_exams')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreign('question_id')
                ->references('id')
                ->on('questions')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreign('answer_id')
                ->references('id')
                ->on('answers')
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
        Schema::table('participant_exams_answers', function(Blueprint $table) {

            $table->dropForeign('participant_exams_answers_participant_exam_id_foreign');
            $table->dropForeign('participant_exams_answers_question_id_foreign');
            $table->dropForeign('participant_exams_answers_answer_id_foreign');
        });

        Schema::drop('participant_exams_answers');
    }
}
