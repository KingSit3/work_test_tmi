<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestErrorQueueLogEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $job;
    public $payload;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($job, $payload)
    {
        $this->job = $job;
        $this->payload = $payload;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Error Queue")->view('emails.test-failed-queue-mail');
    }
}
