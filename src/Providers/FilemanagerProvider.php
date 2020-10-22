<?php

namespace Smallworldfs\Filemanager\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Smallworldfs\Filemanager\Contracts\UserFilemanager;

class FilemanagerProvider extends ServiceProvider
{
    const FILEMANAGER_PUBLIC = '/filemanager/userfiles/';
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //$this->loadViewsFrom(base_path('vendor/smallworldfs/filemanager-laravel/src/Views'), 'filemanager');
        $this->loadViewsFrom(__DIR__ . '/../Views', 'filemanager');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
        $this->registerGates();
        $this->registerRoutes();
        //$this->registerLoader();
        //$this->registerCommand();
        //$this->registerView();

        /*$this->app->singleton('', function ($app) {

        });*/
    }

    /**
     * Register config in kernel
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../Config/filemanager.php' => config_path('filemanager.php')
        ]);

        config()->set(['filemanager.base_path' => base_path('vendor/smallworldfs/filemanager-laravel/public/')]);
    }

    /**
     * Register Gate Access in kernel
     * @return void
     */
    public function registerGates() {
        Gate::define('access-filemanager', function (UserFilemanager $user, $roles)
        {
            $roles = str_replace('\\', '', $roles);
            $roles = explode('|', $roles);

            if(! $user->hasAnyRole($roles))
                return false;

            if($user->hasRole('admin')) {
                session()->put('filemanager.public_path', config('filemanager.public_path', self::FILEMANAGER_PUBLIC));
                return true;
            }

            $roleFirst = $user->roles->first();
            session()->put('filemanager.public_path', config('filemanager.roles_path.'.$roleFirst->name));

            return true;
        });
    }

    /**
     * Register Routes in kernel
     * @return void
     */
    public function registerRoutes() {
        Route::middleware([
            config('filemanager.middleware_auth', 'auth'),
            config('filemanager.middleware_access', null),
            'no-cache'
        ])->domain(config('filemanager.domain',config('app.url')))
            ->prefix(config('filemanager.prefix', 'file-manager'))
            ->namespace('\Smallworldfs\Filemanager\Controllers')
            ->group(__DIR__ . '/../Routes/filemanager.php');
    }

    /**
     * Register the translation loader
     *
     * @return void
     */
    protected function registerLoader()
    {
        $this->app->singleton('', function ($app) {
            //TODO
        });
    }

    /**
     * Register the commands in kernel
     * @return void
     */
    protected function registerCommand()
    {
        $this->commands([
            //TODO
        ]);
    }

    /**
     * Register views in kernel
     * @return void
     */
    protected function registerView()
    {
        $this->publishes([
            __DIR__ . '/Views/index.blade.php' => resource_path('views/vendor/filemanager/index.blade.php')
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        //TODO
        return [];
    }
}
