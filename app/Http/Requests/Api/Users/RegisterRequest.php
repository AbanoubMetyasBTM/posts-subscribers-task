<?php

namespace App\Http\Requests\Api\Users;

use App\Http\Requests\Api\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends ApiRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'  => [
                "required",
            ],
            'email' => [
                "required",
                "unique:users,user_email",
            ]
        ];
    }

}
