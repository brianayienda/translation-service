<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Translation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TranslationExportTest extends TestCase
{
    use RefreshDatabase;

    public function test_export_endpoint_returns_fast_and_correct_data()
    {
        // Seed a few records for test
        Translation::factory()->count(1000)->create([
            'locale' => 'en'
        ]);

        // Create a test user
        $user = \App\Models\User::factory()->create();

        $this->actingAs($user, 'sanctum');

        $start = microtime(true);

        $response = $this->getJson('/api/translations/export?locale=en');

        $duration = (microtime(true) - $start) * 1000; // milliseconds

        $response->assertStatus(200);
        $this->assertNotEmpty($response->json());
        $this->assertLessThan(500, $duration, "Export took too long: {$duration}ms");
    }
}
