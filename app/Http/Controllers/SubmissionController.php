<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessSubmission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function submit(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Dispatch job
        ProcessSubmission::dispatch($validated);

        return response()->json(['message' => 'Submission received and processing'], 202);
    }
}

