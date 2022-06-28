<?php

namespace App\Http\Controllers\Api\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Resources\Transaction\TransactionResource;
use App\Models\Transaction\Transaction;
use Illuminate\Http\Request;

class TransactionMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = Transaction::query();

        if ($request->has('fromDate') && $request->fromDate != '' && $request->has('toDate') && $request->toDate != '') {

            $query->whereRaw(
                "(created_at >= ? AND created_at <= ?)",
                [
                    $request->fromDate . " 00:00:00",
                    $request->toDate  . " 23:59:59"
                ]
            );
        } else {
            if ($request->has('fromDate') && $request->fromDate != '') {
                $query->whereRaw(
                    "(created_at >= ? )",
                    [
                        $request->fromDate . " 00:00:00",

                    ]
                );
            }

            if ($request->has('toDate') && $request->toDate != '') {
                $query->whereRaw(
                    "(created_at >= ? AND created_at <= ?)",
                    [
                        '9999-99-99' . " 00:00:00",
                        $request->toDate . " 23:59:59"
                    ]
                );
            }
        }



        $transactions = $query->with(['User', 'Customer'])
            ->orderBy('id', 'DESC')
            ->get();



        return TransactionResource::collection($transactions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transactions = Transaction::query()
            ->where('customer_id', $id)
            ->get();

        $transactionSum = Transaction::query()
            ->where('customer_id', $id)
            ->sum('transaction_amount');


        return TransactionResource::collection($transactions)->additional(['total' => $transactionSum]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
