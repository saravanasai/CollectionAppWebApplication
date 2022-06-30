<?php

namespace App\Http\Controllers\Api\Statistics;

use App\Http\Controllers\Controller;
use App\Http\Resources\Statistics\StatisticAgentResource;
use App\Http\Resources\Statistics\StatisticLocationResource;
use App\Http\Resources\Statistics\StatisticPlanResource;
use App\Models\Agent\Agent;
use App\Models\Collection\Collection;
use App\Models\Customer\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsContoller extends Controller
{

    public function planStatistics()
    {

        $plan_statistics =   DB::table('customers')
            ->join('plans', 'customers.plan_id', '=', 'plans.id')
            ->selectRaw('count(customers.id) as number_of_users,plans.*')
            ->groupBy('customers.plan_id')
            ->get();

        return StatisticPlanResource::collection($plan_statistics);
    }


    public function locationStatistics()
    {

        $location_statistics =   DB::table('customers')
            ->join('locations', 'customers.location_id', '=', 'locations.id')
            ->selectRaw('count(customers.id) as number_of_users,locations.*')
            ->groupBy('customers.location_id')
            ->get();

        return StatisticLocationResource::collection($location_statistics);
    }


    public function agentStatistics()
    {

        $agent_statistics =   DB::table('customers')
            ->join('agents', 'customers.refered_agent_id', '=', 'agents.id')
            ->selectRaw('count(customers.id) as number_of_users,agents.*')
            ->groupBy('customers.refered_agent_id')
            ->get();

        return StatisticAgentResource::collection($agent_statistics);
    }




    public function dashboardStatistics()
    {

        $userCount = Customer::count();
        $agentCount = Agent::count();
        $TotalCollection = Collection::sum('collection_total_due');
        $TotalCollectionBalance = Collection::sum('collection_balance_due');

        $responseData = [
            "userCount" => $userCount,
            "agentCount" => $agentCount,
            "TotalCollection" => (int) $TotalCollection,
            "TotalCollectionBalance" => (int)$TotalCollectionBalance,
        ];

        return response()->json(["data" => $responseData]);
    }
}
