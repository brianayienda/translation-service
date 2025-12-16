<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Translation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Translation>
 */
class TranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Translation::class;
    
    public function definition()
    {
        return [
            'key'    => 'app.key_' . $this->faker->unique()->numberBetween(1, 200000),
            'locale' => $this->faker->randomElement(['en', 'fr', 'es']),
            'value'  => $this->faker->sentence(),
        ];
    }

}
