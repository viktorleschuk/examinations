<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_exams', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('participant_id')
                ->unsigned();
            $table->integer('exam_id')
                ->unsigned();
            $table->smallInteger('status');
            $table->decimal('score')
                ->nullable();
            $table->integer('elapsed_time')
                ->nullable();
            $table->smallInteger('desired_position');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('participant_exams', function (Blueprint $table) {
            $table->foreign('participant_id')
                ->references('id')
                ->on('participants')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreign('exam_id')
                ->references('id')
                ->on('exams')
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
        Schema::table('participant_exams', function(Blueprint $table) {

            $table->dropForeign('participant_exams_participant_id_foreign');
            $table->dropForeign('participant_exams_exam_id_foreign');
        });

        Schema::drop('participant_exams');
    }
}
