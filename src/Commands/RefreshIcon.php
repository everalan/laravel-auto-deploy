<?php

namespace Everalan\AutoDeploy\Commands;

use Illuminate\Console\Command;

class RefreshIcon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh-icon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'refresh-icon';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = base_path('icon');
        $reg = '/^ICON_VERSION=(\w+)/m';

        $ms = [];
        $env = trim(file_get_contents($this->laravel->environmentFilePath()));
        if(!preg_match($reg, $env, $ms))
        {
            $env .= "\nICON_VERSION=0";
        }
        $old_version = $ms[1];

        if(!$version = `git log --oneline -p -1 --name-status|head -n 1|awk '{print $1}'`)
        {
            $this->error('get icon version error');
            return;
        }

        if($version == $old_version)
        {
            $this->warn("icon version $version is NOT newer");
            return;
        }
        file_put_contents($this->laravel->environmentFilePath(), preg_replace(
            $reg,
            "ICON_VERSION=$version",
            $env)
        );
        $this->info("change icon version to $version");
    }
}
