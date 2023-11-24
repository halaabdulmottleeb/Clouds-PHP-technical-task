<?php

namespace App\Repositories;

use App\Models\PaymentPlan;

class PaymentPlanRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new PaymentPlan();
    }
}