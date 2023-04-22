<?php

namespace App\Models;

use Database\Factories\WebsitePostsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsitePostsModel extends Model
{
    use HasFactory;

    protected $table      = "website_posts";
    protected $primaryKey = "post_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'website_id',
        'post_title',
        'post_desc',
        'created_at',
    ];

    public $timestamps = false;

    protected static function newFactory()
    {
        return WebsitePostsFactory::new();
    }

    public static function addNewPost(int $websiteId, string $title, string $body): int
    {

        $postObj = self::create([
            'website_id' => $websiteId,
            'post_title' => $title,
            'post_desc'  => $body,
            'created_at' => date("Y-m-d H:i:s"),
        ]);

        if (!is_object($postObj)) {
            return 0;
        }

        return $postObj->post_id;

    }

}



