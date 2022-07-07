<?php

namespace App\Http\Controllers\Api\Customer;

use App\Action\Collection\CollectionAction;
use App\Action\Collection\CollectionUpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerStoreRequest;
use App\Http\Requests\Customer\CustomerUpdateRequest;
use App\Http\Resources\Customer\CustomerResource;
use App\Models\Customer\Customer;
use Illuminate\Http\Request;

class CustomerMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = Customer::query();


        if ($request->has('searchKey') && $request->searchKey != '') {

            $query->search($request->searchKey)->take(10);
        }

        if ($request->has('location') && $request->location != 0) {
            $query->locationFilter($request->location);
        }

        if ($request->has('plan') && $request->plan != 0) {
            $query->planFilter($request->plan);
        }

        if ($request->has('agent') && $request->agent != 0) {
            $query->agentFilter($request->agent);
        }

        if ($request->has('amount') && $request->amount != 0) {
            $query->amountBalanceFilter($request->amount);
        }

        if($request->has('take') && $request->take!=0)
        {
            $query->take($request->take);
        }

        $customer = $query->with(['Location', 'Plan', 'Agent', 'Collection'])
            ->orderBy('customer_id', 'ASC')
            ->get();

        return CustomerResource::collection($customer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerStoreRequest $request, CollectionAction $action)
    {
        $customer = Customer::create($request->validated());

        $collection = $action->execute($customer->id, $request->plan_id);

        return $customer && $collection
            ? response()->json(["data" => CustomerResource::make($customer)], 201)
            : response()->json(["message" => "something went wrong"], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::query()
            ->find($id)
            ->load('Plan')
            ->load('Collection')
            ->load('Scheme')
            ->load('Agent')
            ->load('Location');

        return $customer
            ? response()->json(["data" => CustomerResource::make($customer)], 201)
            : response()->json(["message" => "something went wrong"], 500);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerUpdateRequest $request, $id, CollectionUpdateAction $action)
    {
        $customer = Customer::query()
            ->find($id);

        //checking if the plan changed on update
        if ($request->is_plan_changed) {
            //action only updated the collection Table
            $action->execute($id, $request->plan_id);
        }

        $customer->update($request->validated());

        return $customer->save()
            ? response()->json(["data" => CustomerResource::make($customer)], 200)
            : response()->json(["message" => "something went wrong"], 500);
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
