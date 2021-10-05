<?php

namespace KontribusiKuy\LapackProfiles;

use Illuminate\Support\ServiceProvider;

class ProfilesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'lapack-profiles');
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
    }

    public function register()
    {
        # code...
    }
}