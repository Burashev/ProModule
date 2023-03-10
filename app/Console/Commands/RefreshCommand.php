<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class RefreshCommand extends Command
{
    protected $signature = 'promodule:refresh';

    protected $description = 'Project refresh';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (app()->isProduction()) {
            return Command::FAILURE;
        }

        $this->call('cache:clear');

        File::cleanDirectory(Storage::disk('files')->path('/'));

        $this->call('migrate:refresh', ['--seed' => true]);

        return Command::SUCCESS;
    }
}
