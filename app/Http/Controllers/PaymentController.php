<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PaymentPlan;
use App\Services\PaymentPlanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public $paymentPlanService;

    public function __construct(PaymentPlanService $paymentPlanService)
    {
        $this->paymentPlanService = $paymentPlanService;
    }
    
    public function create()
    {
        $paymentPlans = PaymentPlan::all();

        return view('payment_plans.select', compact('paymentPlans'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $this->paymentPlanService->createUserPaymentPlan($user->id, $request->all());

        return view('home');
    }
}
