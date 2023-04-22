<?php

namespace Database\Seeders;

use App\Models\UsersModel;
use App\Models\UserSubscriptionsModel;
use App\Models\WebsitesModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    private function populateUserSubs()
    {

        //add all sites to the first user
        $firstUser   = UsersModel::getFirstUser();
        $allWebsites = WebsitesModel::getAllWebsiteIds();
        $insArr      = [];

        foreach ($allWebsites as $site_id) {
            $insArr[] = [
                'user_id'    => $firstUser->user_id,
                'website_id' => $site_id,
            ];
        }


        UserSubscriptionsModel::insert($insArr);

    }


    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\UsersModel::factory(3)->create();
        \App\Models\WebsitePostsModel::factory(5)->create();
        $this->populateUserSubs();

    }
}
