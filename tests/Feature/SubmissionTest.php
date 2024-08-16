<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_submission_is_successful()
    {
        $response = $this->postJson('/api/submit', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ]);

        $response->assertStatus(202);
        $this->assertDatabaseHas('submissions', ['email' => 'john.doe@example.com']);
    }

    public function test_submission_validation_fails()
    {
        $response = $this->postJson('/api/submit', [
            'name' => '',
            'email' => '',
            'message' => '',
        ]);

        $response->assertStatus(422);
    }
}
