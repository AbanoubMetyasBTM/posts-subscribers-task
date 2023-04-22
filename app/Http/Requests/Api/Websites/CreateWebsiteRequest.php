<?php

namespace App\Http\Requests\Api\Websites;

use App\Http\Requests\Api\ApiRequest;

class CreateWebsiteRequest extends ApiRequest
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
            'website_domain' => [
                "required",
                "regex:^[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$^",
                "unique:websites,site_domain",
            ]
        ];
    }


}
