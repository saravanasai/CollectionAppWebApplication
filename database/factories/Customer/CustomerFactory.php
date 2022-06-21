<?php

namespace Database\Factories\Customer;

use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{

    protected $model = Customer::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "customer_id" => $this->faker->unique()->numberBetween(500),
            "f_username" => $this->faker->unique()->name(),
            "s_username" => $this->faker->unique()->name(),
            "primary_phone" => $this->faker->unique()->phoneNumber(),
            "secondary_phone" => $this->faker->unique()->phoneNumber(),
            "location_id" => rand(1, 10),
            "plan_id" => rand(1, 5),
            "refered_agent_id" => rand(1, 10),
            "scheme_id" => 1,
        ];
    }
}
