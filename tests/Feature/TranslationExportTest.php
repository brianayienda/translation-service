<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Translation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TranslationExportTest extends TestCase
{
    use RefreshDatabase;

    public function test_export_endpoint_returns_fast_and_correct_data_with_tags()
{
    // Seed translations with tags
    $tags = ['mobile', 'desktop', 'web'];

    $translations = Translation::factory()->count(1000)->create(['locale' => 'en']);

    foreach ($translations as $translation) {
        $translation->tags()->sync(collect($tags)->random(rand(1,2))->map(function ($name) {
            return \App\Models\Tag::firstOrCreate(['name' => $name])->id;
        }));
    }

    $user = \App\Models\User::factory()->create();
    $this->actingAs($user, 'sanctum');

    $start = microtime(true);

    $response = $this->getJson('/api/translations/export?locale=en');
    // dd($response->json());


    $duration = (microtime(true) - $start) * 1000;

    $response->assertStatus(200);

    $data = $response->json();

    $this->assertNotEmpty($data);
    $this->assertIsArray($data);
    $this->assertArrayHasKey($translations->first()->key, $data);
    $this->assertArrayHasKey('tags', $data[$translations->first()->key]);

    $this->assertLessThan(500, $duration, "Export took too long: {$duration}ms");
}

}
