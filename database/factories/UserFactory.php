<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\User;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'password' => $this->faker->password,
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'telegram_chat_id' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'birthday' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'auth_code' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'role_id' => Role::factory(),
            'email_verified_at' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'phone_verified_at' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'blocked_at' => $this->faker->regexify('[A-Za-z0-9]{255}'),
        ];
    }
}
