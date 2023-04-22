<?php


namespace App\Services\Implementation;


use App\Models\WebsitesModel;
use App\Services\IWebsiteService;

class WebsiteService implements IWebsiteService
{

    public function getAllWebsites(): array
    {

        return WebsitesModel::getAllWebsiteDomains();

    }

    public function createNewWebsite($websiteDomain): bool
    {

        return WebsitesModel::createNewWebsite($websiteDomain);

    }

}
