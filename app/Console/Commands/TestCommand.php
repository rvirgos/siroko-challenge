<?php

namespace App\Console\Commands;

use App\Models\Cart\Infrastructure\EloquentCartItemRepository;
use Exception;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'test:test';

    protected $description = 'Command to testing';

    public function handle(): void
    {

    }
}
