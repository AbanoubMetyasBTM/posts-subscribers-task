<?php


namespace App\Services;


interface IWebsiteService
{

    public function getAllWebsites(): array;

    public function createNewWebsite($websiteDomain): bool;

}
