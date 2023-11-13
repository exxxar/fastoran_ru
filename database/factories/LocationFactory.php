<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Company;
use App\Models\Location;

class LocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Location::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'region' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'city' => $this->faker->city,
            'district' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'address' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'landmark' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'object_type' => $this->faker->numberBetween(-10000, 10000),
            'object_id' => Company::factory(),
            'deleted_at' => $this->faker->dateTime(),
        ];
    }
}
