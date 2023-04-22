<?php

namespace App\Http\Requests\Api\Posts;

use App\Http\Requests\Api\ApiRequest;

class AddPostRequest extends ApiRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $domain = $this->request->get('domain');

        return [
            'domain'      => [
                "required",
                "exists:websites,site_domain,site_domain,$domain"
            ],
            'title'       => ['required'],
            'description' => ['required'],
        ];
    }

}
