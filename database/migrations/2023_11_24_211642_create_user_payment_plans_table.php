<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPaymentPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_payment_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_plan_id')->nullable()->constrained('payment_plans');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->dateTime("start_date");
            $table->dateTime("end_date");
            $table->decimal("price");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_payment_plans');
    }
}
