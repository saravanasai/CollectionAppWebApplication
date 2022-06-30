<?php

namespace Database\Seeders;

use App\Models\Plan\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public $plan_list = [
        250, 300, 500, 1000
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0, $length = count($this->plan_list); $i < $length; $i++) {
            $plan = new Plan();
            $plan->plan_amount = $this->plan_list[$i];
            $plan->save();
        }
    }
}
