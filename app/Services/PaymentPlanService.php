<?php

namespace App\Services;

use App\Repositories\PaymentPlanRepository;
use App\Repositories\UserPaymentPlanRepository;

class PaymentPlanService {

    public $paymentPlanRepository;
    public $userPaymentPlanRepository;

    public function __construct(PaymentPlanRepository $paymentPlanRepository, UserPaymentPlanRepository $userPaymentPlanRepository)
    {
        $this->paymentPlanRepository = $paymentPlanRepository;
        $this->userPaymentPlanRepository = $userPaymentPlanRepository;
    }
    
    public function createUserPaymentPlan($userId, $data)
    {
        $payment = $this->paymentPlanRepository->findOneBy(['id' => $data['payment_plan']]);
        $endDate = $payment->calculateEndDate();

        $this->userPaymentPlanRepository->create([
            'payment_plan_id' => $data["payment_plan"],
            'user_id' => $userId,
            'start_date' => now(),
            'end_date' => $endDate,
            'price' => $payment->price,
        ]);
    }
}