<?php

namespace App\Http\Controllers;

use App\Jobs\SpamDummyEmail;
use App\Mail\TestEmailDesu;
use App\Traits\LogQueueTrait;
use App\User;
use Illuminate\Bus\Dispatcher;
use Illuminate\Support\Facades\Mail;

class SendDummyEmailController extends Controller
{
    use LogQueueTrait;

    public function sendEmail(){
        $user = User::first();
        Mail::to("ano-user@gmail.com")->send(new TestEmailDesu($user));
    }

    public function spamEmail(){
        $user = User::first();

        for ($i=0; $i < 10; $i++) { 
            $jobId = app(Dispatcher::class)->dispatch(new SpamDummyEmail($user));

            $this->InitQueueLog("SpamDummyEmail", $jobId, "Spamming Dummy email", "low", ["user" => $user]);
        }
    }
}
