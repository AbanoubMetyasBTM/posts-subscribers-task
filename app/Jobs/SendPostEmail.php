<?php

namespace App\Jobs;

use App\Models\PostDeliveriesModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPostEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $params;

    public function __construct($params)
    {
        $this->params = $params;
    }


    public function handle()
    {

        $deliveryId = $this->params["deliveryId"];
        $userEmail  = $this->params["email"];
        $subject    = $this->params["title"];

        Mail::send("emails.send_post", $this->params, function ($message) use (
            $userEmail, $subject
        ) {
            $message->to($userEmail)->subject($subject);
        });

        PostDeliveriesModel::markAsSent($deliveryId);

    }
}
