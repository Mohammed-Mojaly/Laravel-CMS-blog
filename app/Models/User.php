<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Mindscms\Entrust\Traits\EntrustUserWithPermissionsTrait;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable , EntrustUserWithPermissionsTrait , SearchableTrait , HasApiTokens;

    protected $guarded = [];


    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $searchable = [

        'columns'  => [
            'users.name'           => 10,
            'users.username'       => 10,
            'users.email'          => 10,
            'users.name'           => 10,
            'users.mobile'         => 10,
            'users.bio'            => 10,

        ],
    ];

    public function receivesBroadcastNotificationsOn()
    {
        return 'App.User.'.$this->id;
    }
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }


    public function status(){
        return $this->status == 1 ? 'Active' : 'Inactive';
    }

    public function userImage()
    {
        return $this->user_image != ''?  asset('assets/users/' .$this->user_image ) : asset('assets/users/user.png');
    }
}
