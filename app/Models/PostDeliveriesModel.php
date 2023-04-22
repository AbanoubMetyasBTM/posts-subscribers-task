<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PostDeliveriesModel extends Model
{
    use HasFactory;

    protected $table      = "post_deliveries";
    protected $primaryKey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'post_id',
        'user_id',
        'is_sent',
    ];

    public $timestamps = false;

    private static function mainQuery()
    {
        return self::
        select(
            "post_deliveries.id",
            "users.user_email",
            "website_posts.post_title",
            "website_posts.post_desc",
        )->
        join("users", "users.user_id", "=", "post_deliveries.user_id")->
        join("website_posts", "website_posts.post_id", "=", "post_deliveries.post_id");
    }

    public static function getUnsentRowsByPostId(int $postId): Collection
    {

        return self::mainQuery()->
        where("post_deliveries.post_id", $postId)->
        where("post_deliveries.is_sent", 0)->
        get();

    }

    public static function getUnsentRows(): Collection
    {

        return self::
        mainQuery()->
        where("post_deliveries.is_sent", 0)->
        get();

    }

    public static function markAsSent($id){
        self::find($id)->update([
            "is_sent" => 1
        ]);
    }


}



