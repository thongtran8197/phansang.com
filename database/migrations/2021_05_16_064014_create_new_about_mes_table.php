<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewAboutMesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_about_mes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("logo_image");
            $table->string("image");
            $table->text('title');
            $table->text('title_en');
            $table->text('title_fr');
            $table->text('content');
            $table->text('content_en');
            $table->text('content_fr');
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
        Schema::dropIfExists('new_about_mes');
    }
}
