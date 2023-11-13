<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Company;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'domain' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'logo' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'vk_group' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'telegram_channel' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'description' => $this->faker->text,
            'contacts' => '{}',
            'socials' => '{}',
            'bots' => '{}',
            'banners' => '{}',
            'site_url' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'is_active' => $this->faker->boolean,
            'payment_card' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'work_time' => '{}',
            'amo_link' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'amo_login' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'amo_password' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'deleted_at' => $this->faker->dateTime(),
        ];
    }
}
