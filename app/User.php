<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the messages for the user.
     */
    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    /**
     * Oauth Access Token.
     */
    public function OauthAccessToken()
    {
        return $this->hasMany('\App\OauthAccessToken');
    }
}
