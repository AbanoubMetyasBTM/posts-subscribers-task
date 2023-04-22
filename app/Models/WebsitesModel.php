<?php

namespace App\Models;

use Database\Factories\WebsiteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsitesModel extends Model
{
    use HasFactory;

    protected $table      = "websites";
    protected $primaryKey = "site_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'site_domain',
    ];

    public $timestamps = false;

    protected static function newFactory()
    {
        return WebsiteFactory::new();
    }

    public static function getAllWebsiteIds(): array
    {
        return WebsitesModel::all()->pluck("site_id")->all();
    }

    public static function getAllWebsiteDomains(): array
    {
        return WebsitesModel::all()->pluck("site_domain")->all();
    }

    public static function createNewWebsite(string $websiteDomain): bool
    {

        $websiteObj = self::create([
            'site_domain' => $websiteDomain
        ]);

        if(is_object($websiteObj)){
            return true;
        }

        return false;

    }

    public static function getRowByDomainName(string $domainName): ?WebsitesModel
    {

        return self::where("site_domain", $domainName)->limit(1)->get()->first();

    }

}



