<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "customer_id"=>['required','unique:customers,customer_id'],
            "f_username"=>['required'],
            "s_username"=>['present'],
            "primary_phone"=>['required'],
            "secondary_phone"=>['present'],
            "location_id"=>['required'],
            "plan_id"=>['required'],
            "refered_agent_id"=>['required'],
            "scheme_id"=>['required','numeric'],
        ];
    }
}
