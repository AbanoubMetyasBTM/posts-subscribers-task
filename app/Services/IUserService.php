<?php


namespace App\Services;


interface IUserService
{

    public function register(string $fullName, string $email): bool;

    public function subscribe(string $websiteDomain, string $email): string;

    public function unSubscribe(string $websiteDomain, string $email): bool;

}
