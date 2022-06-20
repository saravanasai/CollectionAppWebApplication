<?php

namespace Database\Factories\Agent;

use App\Models\Agent\Agent;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgentFactory extends Factory
{

    protected $model = Agent::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'agent_id' => $this->faker->unique()->buildingNumber(),
            'agent_name' => $this->faker->unique()->name(),
            'agent_phone' => $this->faker->unique()->phoneNumber(),
            'agent_location_id' => rand(1, 10),
        ];
    }
}
