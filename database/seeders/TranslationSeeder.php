<?php

namespace Database\Seeders;

use App\Models\Translation;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TranslationSeeder extends Seeder
{
    public function run(): void
    {
        $tags = ['mobile', 'desktop', 'web'];

        // Ensure tags exist
        foreach ($tags as $tagName) {
            Tag::firstOrCreate(['name' => $tagName]);
        }

        // Create translations and assign tags
        Translation::factory()
            ->count(100000)
            ->create()
            ->each(function ($translation) use ($tags) {
                $tagIds = collect($tags)
                    ->random(rand(1, 2)) // assign 1-2 random tags
                    ->map(fn($name) => Tag::firstOrCreate(['name' => $name])->id);

                $translation->tags()->sync($tagIds);
            });
    }
}
