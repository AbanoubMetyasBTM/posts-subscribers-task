<?php

namespace App\Listeners;

use App\Events\CreatePostEvent;
use App\Jobs\SendPostEmail;
use App\Models\PostDeliveriesModel;
use App\Models\WebsitePostsModel;

class SendPostToSubscribers
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

        $rows = PostDeliveriesModel::getUnsentRowsByPostId($postId);
        foreach ($rows as $row) {
            dispatch(new SendPostEmail([
                "deliveryId" => $row->id,
                "email"      => $row->user_email,
                "title"      => $row->post_title,
                "desc"       => $row->post_desc,
            ]));
        }


    }
}
