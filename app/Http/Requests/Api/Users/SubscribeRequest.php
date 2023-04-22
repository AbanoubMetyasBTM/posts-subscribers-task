<?php

namespace App\Http\Requests\Api\Users;

use App\Http\Requests\Api\ApiRequest;

class SubscribeRequest extends ApiRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        //i could do exist validation here but i just want to make the service has some logic inside :)
        return [
            'email'  => [
                "required",
            ],
            'domain' => [
                "required",
            ]
        ];
    }

}
