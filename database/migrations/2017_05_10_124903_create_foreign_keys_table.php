<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });

        Schema::table('comment_replies', function (Blueprint $table) {
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
        });

        Schema::table('photo_sizes', function (Blueprint $table) {
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
        });

        Schema::table('ratings', function (Blueprint $table) {
            $table->foreign('star_id')->references('id')->on('stars')->onDelete('cascade');
        });

        Schema::table('social_media_links', function (Blueprint $table) {
            $table->foreign('social_media_id')->references('id')->on('social_media')->onDelete('cascade');
        });

        Schema::table('taggables', function (Blueprint $table) {
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });

        Schema::table('forms', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });

        Schema::table('form_answers', function (Blueprint $table) {
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('comments_post_id_foreign');
        });

        Schema::table('comment_replies', function (Blueprint $table) {
            $table->dropForeign('comment_replies_comment_id_foreign');
        });

        Schema::table('photo_sizes', function (Blueprint $table) {
            $table->dropForeign('photo_sizes_photo_id_foreign');
        });

        Schema::table('ratings', function (Blueprint $table) {
            $table->dropForeign('ratings_star_id_foreign');
        });

        Schema::table('social_media_links', function (Blueprint $table) {
            $table->dropForeign('social_media_links_social_media_id_foreign');
        });

        Schema::table('taggables', function (Blueprint $table) {
            $table->dropForeign('taggables_tag_id_foreign');
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign('employees_company_id_foreign');
        });

        Schema::table('forms', function (Blueprint $table) {
            $table->dropForeign('forms_employee_id_foreign');
            $table->dropForeign('forms_company_id_foreign');
        });

        Schema::table('form_answers', function (Blueprint $table) {
            $table->dropForeign('form_answers_form_id_foreign');
        });
    }
}
