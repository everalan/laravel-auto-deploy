<?php

namespace Everalan\AutoDeploy;

use Everalan\AutoDeploy\Commands\AutoDeploy;
use Everalan\AutoDeploy\Commands\RefreshIcon;
use Illuminate\Support\ServiceProvider;

class AutoDeployServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->commands([
            AutoDeploy::class,
            RefreshIcon::class
        ]);
    }
}
