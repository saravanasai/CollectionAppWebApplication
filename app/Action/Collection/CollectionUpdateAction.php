<?php
namespace App\Action\Collection;
use App\Models\Collection\Collection;
use App\Models\Plan\Plan;

class CollectionUpdateAction
{

    public function execute($customerId, $planId)
    {
        $planAmount = Plan::find($planId)->plan_amount;

        $collectionUpdated = Collection::find($customerId)->update([
            "plan_id" => $planId,
            "collection_total_due" => $planAmount * 12,
        ]);

        return $collectionUpdated ? true : false;
    }
}
