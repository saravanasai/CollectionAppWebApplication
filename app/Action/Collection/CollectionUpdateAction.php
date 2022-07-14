<?php

namespace App\Action\Collection;

use App\Models\Collection\Collection;
use App\Models\Plan\Plan;

class CollectionUpdateAction
{

    public function execute($customerId, $planId)
    {
        $newPlanAmount = Plan::find($planId)->plan_amount;

        $collection = Collection::find($customerId);

        $amountPaidPreviously = ($collection->collection_total_due - $collection->collection_balance_due);

        $collection->update([
            "plan_id" => $planId,
            "collection_total_due" => $newPlanAmount * 12,
            "collection_balance_due" => ($newPlanAmount * 12) -  $amountPaidPreviously,
        ]);

        return $collection ? true : false;
    }
}
