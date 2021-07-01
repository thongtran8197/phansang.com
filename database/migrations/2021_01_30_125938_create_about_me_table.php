<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutMeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_me', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image_about');
            $table->string('image_event');
            $table->string('image_book');
            $table->string('image_about_1');
            $table->string('image_about_2');
            $table->string('image_about_3');
            $table->string('description');
            $table->string('description_en');
            $table->string('description_fr');
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
        Schema::dropIfExists('about_me');
    }
}
