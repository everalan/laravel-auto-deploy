<?php

namespace Everalan\AutoDeploy\Commands;

use Illuminate\Console\Command;

class AutoDeploy extends Command
{
    protected $signature = 'auto-deploy';

    protected $description = 'Auto deploy';

    public function handle()
    {
        include('../server.php');
    }
}
