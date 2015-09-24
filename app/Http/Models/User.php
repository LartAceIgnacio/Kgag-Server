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
        return User::where('username', $userName) -> get();
    }

    public static function addUser()
    {
        $user = new User;

        $user->username = 'test1';
        $user->password = 'qwerasdzxc';
        $user->firstname = 'testtestFirstName';
        $user->lastname = 'testtestLastName';
        $current_date = date('Y-m-d H:i:s');
        $user->datemodifed = $current_date;
        $user->datecreated = $current_date;

        try {
            // dd($user);
            $user->save();
        } catch (Exception $e) {
            echo $e;
            throw new Exception("Error Processing Request", 1);
        }

        return $user;
    }
}
