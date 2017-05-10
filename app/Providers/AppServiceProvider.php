<?php

namespace App\Providers;

use App\Comment;
use App\CommentReply;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $countOfDisapprovedComments = Schema::hasTable('comments') ? Comment::where('is_active', 0)->count() : null;
        $countOfDisapprovedReplies = Schema::hasTable('comment_replies') ? CommentReply::where('is_active', 0)->count() : null;
        $countOfAllDisapprovedPosts = Schema::hasTable('posts') ? Post::where('is_active', 0)->count() : null;
        $countOfAllDisapprovedUsers = Schema::hasTable('users') ? User::where('is_active', 0)->count() : null;

        $countOfAllDisapprovedComments = $countOfDisapprovedComments + $countOfDisapprovedReplies;
        $countOfAllDisapprovedAlerts = $countOfAllDisapprovedComments + $countOfAllDisapprovedPosts + $countOfAllDisapprovedUsers;

        view()->share('countOfAllDisapprovedComments', $countOfAllDisapprovedComments);
        view()->share('countOfAllDisapprovedPosts', $countOfAllDisapprovedPosts);
        view()->share('countOfAllDisapprovedUsers', $countOfAllDisapprovedUsers);
        view()->share('countOfAllDisapprovedAlerts', $countOfAllDisapprovedAlerts);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Set Carbon language
        Carbon::setLocale(config('app.locale'));
    }
}
