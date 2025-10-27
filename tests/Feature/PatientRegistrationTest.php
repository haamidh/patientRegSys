<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PatientRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_register_and_redirect()
    {
        $payload = [
            'name' => 'Test Patient',
            'email' => 'patient@example.test',
            'phone' => '0712345678',
            'dob' => '1990-01-01',
            'address' => 'Test address'
        ];

        $response = $this->post(route('patients.store'), $payload);

        $response->assertRedirect(route('thankyou'));
        $this->assertDatabaseHas('patients', [
            'email' => 'patient@example.test',
            'name' => 'Test Patient'
        ]);
    }
}
