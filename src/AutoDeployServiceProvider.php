<?php

namespace Everalan\AutoDeploy;

use Everalan\AutoDeploy\Commands\AutoDeploy;
use Illuminate\Support\ServiceProvider;

class AutoDeployServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands([
            AutoDeploy::class
        ]);
    }

    public function register()
    {
    }
}
