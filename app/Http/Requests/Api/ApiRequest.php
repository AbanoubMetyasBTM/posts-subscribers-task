<?php


namespace App\Http\Requests\Api;


use App\Helpers\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiRequest extends FormRequest
{

    public function failedValidation(Validator $validator)
    {

        $response = ResponseHelper::getJsonBadRequestErrorResponse(
            $validator->errors()->messages(),
            'Invalid data send'
        );

        throw new HttpResponseException($response);
    }

}
