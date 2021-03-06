<?php

namespace App\Http\Controllers\Api\Location;

use App\Http\Controllers\Controller;
use App\Http\Resources\Location\LocationResource;
use App\Models\Location\Location;
use Illuminate\Http\Request;

class LocationMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LocationResource::collection(Location::all());
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
            "location_id" => ['required', 'unique:locations,location_id', 'numeric'],
            "location_name" => ['required'],
        ]);

        return LocationResource::make(Location::create(["location_id" => $request->location_id, "location_name" => $request->location_name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        return LocationResource::make($location);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        $this->validate($request, [
            "location_name" => ['required'],
        ]);

        $isUpdated = $location->update([
            "location_name" => $request->location_name,
        ]);

        return $isUpdated
            ?  response()->json(["message" => "Location Information Updated"], 200)
            :  response()->json(["message" => "Something Went Wrong"], 500);
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
