<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
            "f_username" => ['required'],
            "s_username" => ['sometimes'],
            "primary_phone" => ['required'],
            "secondary_phone" => ['sometimes'],
            "plan_id" => ['required'],
            "location_id" => ['required'],
            "refered_agent_id" => ['required'],
        ];
    }
}
