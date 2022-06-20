<?php


namespace App\Action\Collection;

use App\Models\Collection\Collection;
use App\Models\Plan\Plan;

class CollectionAction
{



    public function execute($customerId, $planId)
    {

        $planAmount = Plan::find($planId)->plan_amount;

        $collection = Collection::create([
            "customer_id" => $customerId,
            "plan_id" => $planId,
            "collection_total_due" => $planAmount * 12,
            "collection_balance_due" => $planAmount * 12,
        ]);

        return $collection ? true : false;
    }
}
