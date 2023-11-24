<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentPlan extends Model
{
    use HasFactory;
    const MONTHLY = "monthly";
    const YEARLY = "yearly";

    protected $guarded = [];

    public function calculateEndDate()
    {
        $startDate = now();

        if ($this->type === 'monthly') {
            return $startDate->addMonth();
        } elseif ($this->type === 'yearly') {
            return $startDate->addYear();
        }else{
            return now();
        }
    }
}
