<?php

namespace App\Http\Controllers\Api\Agent;

use App\Http\Controllers\Controller;
use App\Http\Resources\Agent\AgentResource;
use App\Models\Agent\Agent;
use Illuminate\Http\Request;

class AgentMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AgentResource::collection(Agent::with('Location')->orderBy('id', 'ASC')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "agent_name" => ['required'],
            "agent_phone" => ['required', 'numeric'],
            "agent_location_id" => ['required'],
        ]);

        $is_saved = Agent::create([
            "agent_id" => "AG-" . random_int(1000, 9999),
            "agent_name" => $request->agent_name,
            "agent_phone" => $request->agent_phone,
            "agent_location_id" => $request->agent_location_id,
        ]);

        return $is_saved
            ? response()->json(["data" => AgentResource::make($is_saved)], 201)
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
        //
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
        Agent::destroy($id);

        return response()->noContent();
    }
}
