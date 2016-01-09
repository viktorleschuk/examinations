<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;

    const ROLE_PARTICIPANT    =  1;
    const ROLE_ADMIN   =  2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
        'first_name', 'last_name',
        'role'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->getAttribute('role') == self::ROLE_ADMIN;
    }

    /**
     * @return bool
     */
    public function isParticipant()
    {
        return $this->getAttribute('role') == self::ROLE_PARTICIPANT;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->getAttribute('first_name') . ' ' . $this->getAttribute('last_name');
    }

    public static function getParticipants()
    {
        return self::select()
            ->where('role', self::ROLE_PARTICIPANT)->get();
    }
}
