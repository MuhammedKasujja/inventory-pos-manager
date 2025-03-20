<?php

namespace App\Jobs;

use App\Events\GotUploadData;
use App\Models\DataUpload;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreDataUpdates implements ShouldQueue
{
    use Dispatchable, Queueable, InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public DataUpload $data)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        GotUploadData::dispatch([
            'id' => $this->data->id,
            'user_id' => $this->data->user_id,
            'data' => $this->data->data,
            'account_id' => $this->data->account_id,
            'creator_id' => $this->data->creator_id,
        ]);
    }
}
