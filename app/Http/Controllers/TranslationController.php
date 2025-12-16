<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Translation;
use App\Models\Tag;

class TranslationController extends Controller
{
    public function store(Request $request)
{
    $data = $request->validate([
        'key' => 'required|string',
        'locale' => 'required|string',
        'value' => 'required|string',
        'tags' => 'array'
    ]);

    $translation = Translation::create($data);

    if (!empty($data['tags'])) {
        $tagIds = collect($data['tags'])
            ->map(fn ($name) => Tag::firstOrCreate(['name' => $name])->id);

        $translation->tags()->sync($tagIds);
    }

    return response()->json($translation->load('tags'), 201);
}

public function search(Request $request)
{
    return Translation::query()
        ->when($request->key, fn ($q) =>
            $q->where('key', 'like', "%{$request->key}%"))
        ->when($request->locale, fn ($q) =>
            $q->where('locale', $request->locale))
        ->when($request->tag, fn ($q) =>
            $q->whereHas('tags', fn ($t) =>
                $t->where('name', $request->tag)))
        ->limit(100)
        ->get();
}



public function export(Request $request)
{
    $locale = $request->get('locale', 'en');

    return Cache::remember(
        "export_{$locale}",
        now()->addSeconds(30),
        function () use ($locale) {
            return Translation::where('locale', $locale)
                ->get(['key', 'value'])
                ->pluck('value', 'key');
        }
    );
}


}
