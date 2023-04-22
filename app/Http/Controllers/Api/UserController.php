<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Users\RegisterRequest;
use App\Http\Requests\Api\Users\SubscribeRequest;
use App\Http\Requests\Api\Users\UnSubscribeRequest;
use App\Services\IUserService;

class UserController extends Controller
{

    public $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }


    public function register(RegisterRequest $request)
    {

        $checkRes = $this->userService->register(
            $request->name,
            $request->email
        );

        if (!$checkRes) {
            return ResponseHelper::getJsonBadRequestErrorResponse(
                [
                    "is_created" => 0
                ],
                "Please change email and try again"
            );
        }

        return ResponseHelper::postJsonSuccessResponse(
            [
                "is_created" => 1
            ],
            "Created Successfully"
        );

    }


    public function subscribe(SubscribeRequest $request)
    {

        $checkRes = $this->userService->subscribe(
            $request->domain,
            $request->email
        );

        if (empty($checkRes)) {
            return ResponseHelper::getJsonSuccessResponse(
                [
                    "is_created" => 1
                ],
                ""
            );
        }

        return ResponseHelper::getJsonBadRequestErrorResponse(
            [
                "is_created" => 0
            ],
            $checkRes
        );

    }

    public function unSubscribe(UnSubscribeRequest $request)
    {

        $checkRes = $this->userService->unSubscribe(
            $request->domain,
            $request->email
        );

        if ($checkRes) {
            return ResponseHelper::getJsonSuccessResponse(
                [
                    "deleted" => 1
                ],
                ""
            );
        }

        return ResponseHelper::getJsonBadRequestErrorResponse(
            [
                "deleted" => 0
            ],
            "It might be you didn't subscribe to this before"
        );

    }


}
