<?php


namespace App\Services\Implementation;


use App\Models\UsersModel;
use App\Models\UserSubscriptionsModel;
use App\Models\WebsitesModel;
use App\Services\IUserService;

class UserService implements IUserService
{


    public function register(string $fullName, string $email): bool
    {

        $checkUser = UsersModel::getUserByEmail($email);
        if (is_object($checkUser)) {
            return false;
        }

        return UsersModel::createUser($fullName, $email);

    }

    public function subscribe(string $websiteDomain, string $email): string
    {

        //i could do exist validation at the request class but i just want to make the service has some logic inside :)
        $domainObj = WebsitesModel::getRowByDomainName($websiteDomain);
        if (!is_object($domainObj)) {
            return "Invalid Domain";
        }

        $checkUser = UsersModel::getUserByEmail($email);
        if (!is_object($checkUser)) {
            return "Invalid Email";
        }

        $checkInserted = UserSubscriptionsModel::userSubscribeDomain($checkUser->user_id, $domainObj->site_id);
        if ($checkInserted === false) {
            return "please try again";
        }

        return "";

    }

    public function unSubscribe(string $websiteDomain, string $email): bool
    {
        $domainObj = WebsitesModel::getRowByDomainName($websiteDomain);
        $checkUser = UsersModel::getUserByEmail($email);

        return UserSubscriptionsModel::userUnSubscribeDomain($checkUser->user_id, $domainObj->site_id);
    }
}
