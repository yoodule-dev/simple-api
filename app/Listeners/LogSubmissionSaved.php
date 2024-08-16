<?php

namespace App\Listeners;

use App\Events\SubmissionSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogSubmissionSaved
{
    public function handle(SubmissionSaved $event)
    {
        Log::info("Submission saved for {$event->name} ({$event->email})");
    }
}

