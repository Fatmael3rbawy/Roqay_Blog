<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Http\Interfaces\BaseRepositoryInterface',
            'App\Http\Eloquent\BaseRepository',
            

        );
        $this->app->bind(
            'App\Http\Interfaces\UserRepositoryInterface',
            'App\Http\Eloquent\UserRepository',
            

        );
        $this->app->bind(
            
            'App\Http\Interfaces\PostRepositoryInterface',
            'App\Http\Eloquent\PostRepository',
         
           
        ); 
        $this->app->bind(
            
            'App\Http\Interfaces\TagRepositoryInterface',
            'App\Http\Eloquent\TagRepository'

        );
        $this->app->bind(
            
            'App\Http\Interfaces\CategoryRepositoryInterface',
            'App\Http\Eloquent\CategoryRepository',


        );
        $this->app->bind(
            
            'App\Http\Interfaces\TransactionRepositoryInterface',
            'App\Http\Eloquent\TransactionRepository',
         
           
        ); 
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
       
    }
}
