<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class Request extends FormRequest
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
            "name_client" => 'required',
            "number" => 'required',
            "type_realstate" => 'required',
            "type_request" => 'required',
            "space_min" => 'required|integer',
            "space_max" => 'required|integer',
            "price_min" => 'required|integer',
            "price_max" => 'required|integer',
            "information" => 'required',
            "status" => 'required|in:new,send,Canceled,Completed',


        ];

    }


}
