<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('layouts.sidebar', function($view)
        {
            $view->with('popular_posts', Post::query()->orderBy('views', 'desc')->limit(3)->get());
        });

        view()->composer('layouts.navbar', function($view)
        {
            if (Cache::has('cats_name')) {
                $cats_name = Cache::get('cats_name');
            }
            else {
                $cats_name = Category::query()->select('title', 'slug')->get();
                Cache::put('cats_name', $cats_name, 1800); //in seconds
            }

            $view->with('cats_name', $cats_name);
        });

        view()->composer('layouts.sidebar', function ($view)
        {
            if (Cache::has('cats')) {
                $cats = Cache::get('cats');
            }
            else {
                $cats = Category::query()->withCount('posts')->orderBy('posts_count', 'desc')->get();
                Cache::put('cats', $cats, 1800); //in seconds
            }
            $view->with('cats', $cats );
        });  //https://laravel.com/docs/8.x/eloquent-relationships#counting-related-models
        //App::make('files')->link(storage_path('app/public'), public_path('storage'));
        Paginator::useBootstrap();
        Validator::extend('cyrillic', function($attribute, $value, $parameters, $validator) {
            return preg_match('/[А-Яа-яЁёA-Za-z]/u', $value);
        });
    }
}
