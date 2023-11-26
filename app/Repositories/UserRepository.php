<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new User();
    }

    public function search($data)
    {
       return  $this->model->query()->where('email', 'like', "%" . $data['search'] . "%")->orWhere('name', 'like', "%" . $data['search'] . "%")->get();     
    }
}