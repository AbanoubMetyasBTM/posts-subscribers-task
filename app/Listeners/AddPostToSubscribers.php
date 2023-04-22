<?php

namespace App\Listeners;

use App\Events\CreatePostEvent;
use App\Models\PostDeliveriesModel;
use App\Models\UserSubscriptionsModel;
use App\Models\WebsitePostsModel;

class AddPostToSubscribers
{

    public function __construct()
    {
        //
    }


    public function handle(CreatePostEvent $event)
    {
        $postId  = $event->postId;
        $postObj = WebsitePostsModel::find($postId);

        if (!is_object($postObj)) {
            return;
        }

        //I ignored the returned size of this array, but in real project of course i'll do this as Job with limit and offset
        $allSubscribers = UserSubscriptionsModel::getAllDomainSubscribers($postObj->website_id)->pluck("user_id");
        $insertedArr    = [];
        foreach ($allSubscribers as $userId) {
            $insertedArr[] = [
                'user_id' => $userId,
                'post_id' => $postId,
                'is_sent' => 0,
            ];
        }

        PostDeliveriesModel::insert($insertedArr);
    }
}
