<?php

namespace App\Http\Requests\Api\Users;

use App\Http\Requests\Api\ApiRequest;

class UnSubscribeRequest extends ApiRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $email  = $this->request->get('email');
        $domain = $this->request->get('domain');

        return [
            'email'  => [
                "required",
                "exists:users,user_email,user_email,$email"
            ],
            'domain' => [
                "required",
                "exists:websites,site_domain,site_domain,$domain"
            ]
        ];
    }

}
