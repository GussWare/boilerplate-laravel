<?php

namespace App\Models;

use App\Observers\UserObserver;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'surname',
        'username',
        'email',
        'password',
        'picture',
        'role',
        'enabled',
        'isEmailVerified'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public static function boot() {
        parent::boot();
        self::observe(new UserObserver);
    }

    static public function pagination($filter, $options)
    {
        $limit      = isset($options["limit"]) ? (int) ($options["limit"]) : 15;
        $page       = isset($options["page"]) ? (int) $options["page"] : 1;
        $skip       = ($page - 1) * $limit;
        $totalRows  = DB::table('users')->count();
        $totalPages = ceil($totalRows / $limit);

        $columns    = ["id", "name", "surname", "username", "email", "picture", "role", "enabled", "isEmailVerified", "createdAt", "updatedAt"];

        $query      = DB::table('users');
        $query->select($columns);

        if(isset($options["sortBy"])) {

        }

        $query->offset($skip);
        $query->limit($limit);

        $data = $query->get();

        return [
            "results" => $data,
            "page" => $page,
            "limit" => $limit,
            "totalPages" => $totalPages,
            "totalResults" => $totalRows
        ];
    }


    static public function isEmailTaken(string $email)
    {
        $user = static::where('email', $email);

        return (isset($user->id) && !empty($user->id)) ? true : false;
    }


}
