<?php

namespace App\Console\Commands;

use App\Jobs\SpamDummyEmail;
use App\Traits\LogQueueTrait;
use App\User;
use Illuminate\Bus\Dispatcher;
use Illuminate\Console\Command;
use Illuminate\Queue\InteractsWithQueue;

class SpamGoesBrrrr extends Command
{
    use LogQueueTrait, InteractsWithQueue;

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
        $user = User::first();
        $jobId = app(Dispatcher::class)->dispatch(new SpamDummyEmail($user));

        // Init Log Queue
        $this->InitQueueLog("SpamDummyEmail", $jobId, "Spamming Dummy email", "low", ["user" => $user, "jobId" => $jobId]);
    }
}
