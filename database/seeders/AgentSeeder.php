<?php

namespace Database\Seeders;

use App\Models\Agent\Agent;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agent::factory()->count(10)->create();
    }
}
