<?php

namespace App\Http\Controllers\Api\Scheme;

use App\Http\Controllers\Controller;
use App\Http\Resources\Scheme\SchemeResource;
use App\Models\Scheme\Scheme;
use Illuminate\Http\Request;

class SchemeMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SchemeResource::collection(Scheme::all());
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
            "scheme_name" => ['required'],
            "scheme_start_date" => ['required'],
            "scheme_end_date" => ['required'],
        ]);

        $is_saved = Scheme::create([
            "scheme_name" => $request->scheme_name,
            "scheme_start_date" => $request->scheme_start_date,
            "scheme_end_date" => $request->scheme_end_date,

        ]);

        return $is_saved
            ? response()->json(["data" => SchemeResource::make($is_saved)], 201)
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
        //
    }
}
