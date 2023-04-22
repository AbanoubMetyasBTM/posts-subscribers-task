<?php

namespace App\Models;

use Database\Factories\UsersFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    use HasFactory;

    protected $table      = "users";
    protected $primaryKey = "user_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_fullname',
        'user_email',
    ];

    public $timestamps = false;

    protected static function newFactory()
    {
        return UsersFactory::new();
    }

    public static function getFirstUser(): UsersModel
    {
        return self::limit(1)->get()->first();
    }

    public static function getUserByEmail(string $email): ?UsersModel
    {
        return self::where("user_email", $email)->limit(1)->get()->first();
    }

    public static function createUser(string $name, string $email): bool
    {
        $userObj = self::create([
            'user_fullname' => $name,
            'user_email'    => $email,
        ]);

        if (is_object($userObj)) {
            return true;
        }

        return false;
    }


}



