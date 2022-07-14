<?php

namespace App\Http\Controllers\Api\Complement;

use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use Illuminate\Http\Request;

class ComplementMasterController extends Controller
{

    public function index()
    {
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Customer $complement)
    {


        $this->validate($request, [
            "first_complement" => ['required'],
            "second_complement" => ['required'],
        ]);

        $isUpdated = $complement->update([
            "complement_one" =>$request->first_complement ? 1 : 0,
            "complement_two" =>$request->second_complement ? 1 : 0,
        ]);



        return $isUpdated
            ?  response()->json(["message" => "Complement Information Updated"], 200)
            :  response()->json(["message" => "Something Went Wrong"], 500);
    }
}
