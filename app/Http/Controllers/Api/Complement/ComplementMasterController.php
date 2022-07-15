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
    public function update(Request $request, $id)
    {


        $this->validate($request, [
            "first_complement" => ['required'],
            "second_complement" => ['required'],
        ]);

        $complement = Customer::find($id);

        $isUpdated = $complement->update([
            "complement_one" => $request->first_complement ? true : false,
            "complement_two" => $request->second_complement ? true : false,
        ]);



        return $isUpdated
            ?  response()->json(["message" => "Complement Information Updated"], 200)
            :  response()->json(["message" => "Something Went Wrong"], 500);
    }
}
