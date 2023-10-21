<?php

namespace App\Providers;

use App\Mail\TestErrorQueueLogEmail;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.debug')) {
            error_reporting(E_ALL & ~E_USER_DEPRECATED);
        } else {
            error_reporting(0);
        }
        
        //

        Queue::before(function (JobProcessing $event) {
            Log::info("Queue Started: ". $event->job->getJobId(), $event->job->payload());
            
            // $event->connectionName
            // $event->job
            // $event->job->payload()
        });
 
        Queue::after(function (JobProcessed $event) {
            Log::info("Queue Finished: ". $event->job->getJobId(), $event->job->payload());
            // Mail::to("queue-user@gmail.com")->send(new TestErrorQueueLogEmail($event->job, $event->payload()));
            // $event->connectionName
            // $event->job
            // $event->job->payload()
        });

        Queue::failing(function (JobFailed $event) {

            $queuePayload = json_decode($event->job->getRawBody());
            $logData = unserialize($queuePayload->data->command);
            dump($logData);
            Log::alert("Queue Failed: ". $event->job->getJobId(), ["payload" => $logData, "exception" => $event->exception]);
            // $event->connectionName
            // $event->job
            // $event->job->payload()
            // $event->exception
        });
    }
}
