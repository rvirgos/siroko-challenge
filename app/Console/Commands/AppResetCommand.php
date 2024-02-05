<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppResetCommand extends Command
{
    protected $signature = 'app:reset';

    protected $description = 'Reset application';

    public function handle(): void
    {
        $this->call('migrate:fresh');
        $this->call('db:seed');
        $this->call('serve');
        $this->call('serve', ['--port' => env('API_PORT')]);
        session()->flush();
    }
}
