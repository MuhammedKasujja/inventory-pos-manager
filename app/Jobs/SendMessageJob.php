<?php

namespace App\Jobs;

use App\Events\SendMessage;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMessageJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        SendMessage::dispatch([
            'id' => "56788",
            'user_id' => "8793493",
            'data' => "This is awesome",
            'account_id' => "Kaltech stores",
            'creator_id' => "Kasujja Muhammed",
        ]);
    }
}
