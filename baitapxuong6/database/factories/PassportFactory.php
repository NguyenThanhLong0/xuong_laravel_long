<?php

namespace Database\Factories;

use App\Models\Passport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Passport>
 */
class PassportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Passport::class;

    public function definition()
    {
        return [
            'passport_number' => $this->faker->unique()->numerify('########'),
            'issued_date' => $this->faker->date(),
            'expiry_date' => $this->faker->date(),
        ];
    }
}
