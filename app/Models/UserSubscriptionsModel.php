<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class UserSubscriptionsModel extends Model
{
    use HasFactory;

    protected $table      = "user_subscriptions";
    protected $primaryKey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'website_id',
    ];

    public $timestamps = false;

    public static function getSubscribedDomain(int $userId, int $domainId)
    {
        return self::where([
            'user_id'    => $userId,
            'website_id' => $domainId,
        ])->limit(1)->get()->first();
    }

    public static function userSubscribeDomain(int $userId, int $domainId): bool
    {

        $checkExistBefore = self::getSubscribedDomain($userId, $domainId);
        if (is_object($checkExistBefore)) {
            return true;
        }

        $createdObj = self::create([
            'user_id'    => $userId,
            'website_id' => $domainId,
        ]);

        if (!is_object($createdObj)) {
            return false;
        }

        return true;
    }

    public static function userUnSubscribeDomain(int $userId, int $domainId): bool
    {

        $checkExistBefore = self::getSubscribedDomain($userId, $domainId);
        if (!is_object($checkExistBefore)) {
            return false;
        }

        $checkExistBefore->delete();
        return true;

    }

    public static function getAllDomainSubscribers(int $domainId): Collection
    {
        return self::where([
            'website_id' => $domainId,
        ])->get();
    }

}



