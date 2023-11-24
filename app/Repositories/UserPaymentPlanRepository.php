<?php

namespace App\Repositories;


use App\Models\UserPaymentPlan;

class UserPaymentPlanRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new UserPaymentPlan();
    }
}