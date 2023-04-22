<?php

namespace App\Console\Commands;

use App\Jobs\SendPostEmail;
use App\Models\PostDeliveriesModel;
use Illuminate\Console\Command;

class checkIfEveryNotificationIsSent extends Command
{

    protected $signature = 'notifications:send';

    protected $description = 'check If Every Notification IsSent and if not, send';


    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        $rows = PostDeliveriesModel::getUnsentRows();

        foreach ($rows as $row) {
            dispatch(new SendPostEmail([
                "deliveryId" => $row->id,
                "email"      => $row->user_email,
                "title"      => $row->post_title,
                "desc"       => $row->post_desc,
            ]));
        }


        return 1;
    }
}
