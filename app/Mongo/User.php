<?php

namespace App\Mongo;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    protected $connection = 'mongodb';

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
}
