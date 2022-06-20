<?php

namespace Database\Factories\Collection;

use App\Models\Collection\Collection;
use App\Models\Plan\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollectionFactory extends Factory
{


    protected $model = Collection::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $planId = rand(1, 5);

        $planAmount = Plan::find($planId)->plan_amount;

        $amount = $planAmount * 12;

        return [
            'plan_id' => $planId,
            'collection_total_due' => $amount,
            'collection_balance_due' => $amount,
        ];
    }
}
