<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Ingredient;
use App\Models\IngredientCategory;
use App\Models\Product;

class IngredientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ingredient::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->text,
            'image' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'weight' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'price' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'ingredient_category_id' => IngredientCategory::factory(),
            'product_id' => Product::factory(),
            'is_checked' => $this->faker->boolean,
            'is_disabled' => $this->faker->boolean,
        ];
    }
}
