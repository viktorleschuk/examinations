<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('country_id')->unsigned();
            $table->string('city');
            $table->string('phone_number', 20);
            $table->string('skype_name', 255);
            $table->string('cv_file');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('participants', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
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
        Schema::table('participants', function(Blueprint $table) {

            $table->dropForeign('participants_user_id_foreign');
            $table->dropForeign('participants_country_id_foreign');
        });

        Schema::drop('participants');
    }
}
