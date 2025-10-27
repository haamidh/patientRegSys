<?php

namespace Tests\Feature;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPatientCrudTest extends TestCase
{
    use RefreshDatabase;
    protected function test_createAdmin()
    {
        return User::factory()->create(['is_admin' => true]);
    }

    public function test_admin_can_view_patient_list()
    {
        $admin = $this->test_createAdmin();
        Patient::factory()->count(3)->create();

        $this->actingAs($admin)
            ->get(route('patients.index'))
            ->assertStatus(200)
            ->assertSee('patients');
    }

    public function test_admin_can_update_patient()
    {
        $admin = $this->test_createAdmin();
        $patient = Patient::factory()->create(['name' => 'old name']);

        $this->actingAs($admin)
            ->put(route('patients.update', $patient->id), [
                'name' => 'New Name',
                'email' => $patient->email,
                'phone' => $patient->phone,
                'dob' => $patient->dob,
                'address' => $patient->address,
            ])
            ->assertRedirect(route('patients.index'));
        $this->assertDatabaseHas('patients', ['id' => $patient->id, 'name' => 'New Name']);
    }

    public function test_admin_can_delete_patient()
    {
        $admin = $this->test_createAdmin();
        $patient = Patient::factory()->create();

        $this->actingAs($admin)
            ->delete(route('patients.destroy', $patient->id))
            ->assertRedirect();

        $this->assertSoftDeleted('patients', ['id' => $patient->id]);
    }

    public function test_guests_cannot_access_admin_routes()
    {
        $this->get(route('patients.index'))->assertRedirect(route('login'));
    }
}
