<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Websites\CreateWebsiteRequest;
use App\Services\IWebsiteService;

class WebsiteController extends Controller
{

    public $websiteService;

    public function __construct(IWebsiteService $userService)
    {
        $this->websiteService = $userService;
    }

    public function getAllWebsites()
    {
        return ResponseHelper::getJsonSuccessResponse($this->websiteService->getAllWebsites());
    }

    public function addWebsite(CreateWebsiteRequest $request)
    {

        $isCreated = $this->websiteService->createNewWebsite($request->website_domain);
        if (!$isCreated) {
            return ResponseHelper::getJsonBadRequestErrorResponse(
                [
                    "is_created" => 0
                ],
                "Please try Again"
            );
        }

        return ResponseHelper::postJsonSuccessResponse(
            [
                "is_created" => 1
            ],
            "Created Successfully"
        );


    }


}
