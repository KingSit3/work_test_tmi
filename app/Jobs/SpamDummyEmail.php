<?php

namespace App\Jobs;

use App\Mail\TestEmailDesu;
use App\User;
use App\Traits\LogQueueTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SpamDummyEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, LogQueueTrait;

    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userData)
    {
        $this->user = $userData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->InitQueueLog("SpamDummyEmail", "Spamming Dummy email", "sadasd", ["user_data" => $this->user]);
        Mail::to("spam-ano-user@gmail.com")->send(new TestEmailDesu($this->user));
    }
}
