<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'promodule:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Project installation';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        if (app()->isProduction()) {
            return Command::FAILURE;
        }

        $this->call('key:generate');
        $this->call('storage:link');
        $this->call('telescope:install');
        $this->call('migrate:fresh', ['--seed' => true]);

        return Command::SUCCESS;
    }
}
