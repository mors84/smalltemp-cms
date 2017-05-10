<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialMediaLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_media_links', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('social_media_id')->unsigned()->index();
            $table->integer('social_media_link_id')->unsigned()->index();
            $table->string('social_media_link_type')->index();
            $table->string('profile_link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_media_links');
    }
}
