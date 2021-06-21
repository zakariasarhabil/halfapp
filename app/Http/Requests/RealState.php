<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RealState extends FormRequest
{




protected function failedValidation(Validator $validator)
{
    throw new HttpResponseException(response()->json($validator->errors(), 422));
}
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


                "type_offer" => 'required',
                "type_RealState" => 'required',
                "space" => 'required|integer',
                "price" => 'integer',
                "price_meter" => 'integer',
                "facade" => 'required',
                "location" => 'required',
                "evaluation" => 'required',
                "number_apartment" => 'required|integer',
                "furnished" => 'required|boolean',
                "duplex" => 'required|boolean',
                "driver_room" => 'required|boolean',
                "addition" => 'required|boolean',
                "cellar" => 'required|boolean',
                "elevator" => 'required|boolean',
                "magnifier" => 'required|boolean',
                "specification" => 'required',
                "number_offices" => 'required',
                "type_owner" => 'required',
                'picture' => 'image:jpeg,png,jpg,gif,svg',
                "name_owner" => 'required',
                "phone" => 'required'


        ];
    }
}
