<?php
namespace App\Providers;
use App\Services\ServicesSaveArticleImg;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\ArticleController;
use App\Services\Interfaces\SaveFile;
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
    }
}
