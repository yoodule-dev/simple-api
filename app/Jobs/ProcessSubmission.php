<?php

namespace App\Jobs;

use App\Events\SubmissionSaved;
use App\Models\Submission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessSubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $submissionData;

    /**
     * Create a new job instance.
     *
     * @param array $submissionData
     */
    public function __construct($submissionData)
    {
        $this->submissionData = $submissionData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Save submission to the database
        Submission::create($this->submissionData);

        // Fire the event after saving
        event(new SubmissionSaved($this->submissionData['name'], $this->submissionData['email']));
    }
}
