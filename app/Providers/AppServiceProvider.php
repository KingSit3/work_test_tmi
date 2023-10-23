<?php

namespace App\Providers;

use App\Traits\LogQueueTrait;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    use LogQueueTrait;

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
        
        Queue::before(function (JobProcessing $event) {
            $this->UpdateQueueLogStatus("processing", $event->job->getJobId(), "Queue Started");
        });
 
        Queue::after(function (JobProcessed $event) {
            $this->UpdateQueueLogStatus("success", $event->job->getJobId(), "Queue Finished");
        });

        Queue::failing(function (JobFailed $event) {
            $this->UpdateQueueLogStatus("failed", $event->job->getJobId(), $event->exception->getMessage());
        });
    }
}
