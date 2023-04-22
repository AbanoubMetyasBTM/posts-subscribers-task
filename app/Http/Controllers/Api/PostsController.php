<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Posts\AddPostRequest;
use App\Services\IPostsService;

class PostsController extends Controller
{

    public $postsService;

    public function __construct(IPostsService $postsService)
    {
        $this->postsService = $postsService;
    }


    public function addPost(AddPostRequest $request)
    {

        $checkRes = $this->postsService->addPost($request->validated());

        if (!$checkRes) {
            return ResponseHelper::getJsonBadRequestErrorResponse(
                [
                    "is_created" => 0
                ],
                "try again later"
            );
        }

        return ResponseHelper::postJsonSuccessResponse(
            [
                "is_created" => 1
            ],
            "Created Successfully, and the system start sending notifications to users"
        );

    }



}
