<?php

namespace App\Http\Models;

use DB;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Http\Helpers\ModelKeys;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */

    public $timestamps = false;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = ['password', 'remember_token'];

    public static function findAll()
    {
        return User::all();
    }

    public static function findById($id)
    {
        return User::where('id', $id) -> get();
    }

    public static function findByUserName($userName)
    {
        return User::where('username', $userName) -> get() -> first();
    }

    public static function addUser($data)
    {
        $user = new User;

        $user->username = $data[ModelKeys::username];
        $user->password = $data[ModelKeys::password];
        $user->first_name = $data[ModelKeys::first_name];
        $user->last_name = $data[ModelKeys::last_name];
        $current_date = date('Y-m-d H:i:s');
        $user->date_modified = $current_date;
        $user->date_created = $current_date;

        try {
            $user->save();
        } catch (Exception $e) {
            throw new Exception("Error Processing Request", 1);
        }

        return $user;
    }
}
