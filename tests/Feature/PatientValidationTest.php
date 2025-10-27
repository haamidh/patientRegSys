<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PatientValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_valid_email_and_phone_validation()
    {
        $response = $this->post(route('patients.store'), [
            'name' => '',
            'email' => 'not-an-email',
            'phone' => ''
        ]);
        $response->assertSessionHasErrors(['name', 'email', 'phone']);
        $this->assertDatabaseCount('patients', 0);
    }
}
