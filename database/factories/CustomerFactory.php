<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['individual', 'business']); // Choose random element from the array
        $name = $type === 'individual' ? $this->faker->name() : $this->faker->company();

        return [
            'name' => $name,
            'type' => $type,
            'email' => $this->faker->email(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'postal_code' => $this->faker->postcode()
        ];
    }
}
