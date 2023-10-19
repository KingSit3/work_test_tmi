<?php

namespace App\Console\Commands;

use App\Jobs\SpamDummyEmail;
use Illuminate\Console\Command;

class SpamGoesBrrrr extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:spam';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Spam Email Desu~';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        SpamDummyEmail::dispatchNow();
    }
}
