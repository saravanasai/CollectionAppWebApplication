<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use App\Models\Collection\Collection;
use App\Models\Transaction\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentActionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {

        //validating the request
        $this->validate($request, [
            "amount" => ['required', 'numeric']
        ]);

        // fetch the current collection of user id
        $user_collection = Collection::query()
            ->where('customer_id', $id)
            ->first();

        // check if the user have a balance due to pay
        if ($user_collection->collection_balance_due >= $request->amount) {

            $is_success = DB::transaction(function () use (&$user_collection, &$request, &$id) {

                // update the user collection infomation
                $user_collection->decrement('collection_balance_due', $request->amount);

                // insert into transaction table
                return Transaction::create([
                    "customer_id" => $id,
                    "transaction_amount" => $request->amount,
                    "paid_to" => $request->user()->id,
                ]);
            });


            return $is_success
                ? response()->json(["message" => "Payment Done Successfully"], 200)
                : response()->json(["message" => "Something went wrong"], 500);
        }

        return response()
            ->json(["message" => "{$user_collection->collection_balance_due} is only payable"], 422);
    }
}
