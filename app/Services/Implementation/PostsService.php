<?php


namespace App\Services\Implementation;


use App\Events\CreatePostEvent;
use App\Models\WebsitePostsModel;
use App\Models\WebsitesModel;
use App\Services\IPostsService;

class PostsService implements IPostsService
{

    public function addPost(array $reqData)
    {


        $domainObj = WebsitesModel::getRowByDomainName($reqData["domain"]);
        if (!is_object($domainObj)) {
            return "Invalid Domain";
        }

        $postId = WebsitePostsModel::addNewPost(
            $domainObj->site_id,
            $reqData["title"],
            $reqData["description"],
        );

        if ($postId == 0) {
            return false;
        }

        event(new CreatePostEvent($postId));

        return true;

    }
}
