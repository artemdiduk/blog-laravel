<?php
namespace App\Providers;
use App\Http\Controllers\UserController;
use App\Services\ServiceSavaCommentImg;
use App\Services\ServicesSaveArticleImg;
use App\Services\ServicesSaveAvatar;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\ArticleController;
use App\Services\Interfaces\SaveFile;
use App\Http\Controllers\CommentController;
class SaveFilesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $this->app->when(ArticleController::class)
            ->needs(SaveFile::class)
            ->give(function () {
                return new ServicesSaveArticleImg();
            });
        $this->app->when(UserController::class)
            ->needs(SaveFile::class)
            ->give(function () {
                return new ServicesSaveAvatar();
            });
        $this->app->when(CommentController::class)
            ->needs(SaveFile::class)
            ->give(function () {
                return new ServiceSavaCommentImg();
            });
    }
}
