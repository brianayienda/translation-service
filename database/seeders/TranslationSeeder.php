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

        foreach ($tags as $tagName) {
            Tag::firstOrCreate(['name' => $tagName]);
        }

        $locales = ['en', 'fr', 'es']; // optional multiple locales
        $total = 100000;

        for ($i = 0; $i < $total; $i++) {
            $key = 'app.key_' . $i;
            $locale = $locales[array_rand($locales)];

            $translation = Translation::firstOrCreate(
                ['key' => $key, 'locale' => $locale],
                ['value' => fake()->sentence()]
            );

            // assign 1-2 random tags
            $tagIds = collect($tags)
                ->random(rand(1, 2))
                ->map(fn ($name) => Tag::firstOrCreate(['name' => $name])->id);

            $translation->tags()->sync($tagIds);
        }
    }
}
