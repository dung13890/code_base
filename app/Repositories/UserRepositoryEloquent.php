<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepository;
use App\Traits\ValidatableTrait;
use App\Eloquent\User;

class UserRepositoryEloquent extends AbstractRepositoryEloquent implements UserRepository
{
    use ValidatableTrait;

    protected $rules = [
        'store' => [
            'name' => "required|min:4|max:255",
            'email' => "required|email|max:255|unique:users",
            'password' => 'required|alpha_dash|confirmed|min:6',
            'password_confirmation' => 'required|min:6',
        ],
        'update' => [
            'name' => "required|min:4|max:255",
            'email' => "required|email|max:255|unique:users,email,{id}",
            'password' => 'confirmed|alpha_dash|min:6',
            'password_confirmation' => 'min:6',
        ],
    ];
    
    public function model()
    {
        return new User;
    }

    public function getData($params = [], $columns = ['*'])
    {
        return $this->model()->all($columns);
    }

    public function random($columns = ['*'])
    {
        return $this->model()->inRandomOrder()->first($columns);
    }
}
