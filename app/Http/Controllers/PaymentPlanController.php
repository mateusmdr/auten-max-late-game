<?php

namespace App\Http\Controllers;

use App\Models\PaymentPlan;
use Illuminate\Http\Request;
use App\Http\Resources\PaymentPlanResource;

class PaymentPlanController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(PaymentPlan::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $builder = PaymentPlan::query()->orderBy('price');

        return PaymentPlanResource::collection($builder->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentPlan  $paymentPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentPlan $paymentPlan)
    {
        $request->validate(['price' => 'required|numeric|min:1']);

        $paymentPlan->price = $request->input('price');

        $paymentPlan->save();

        return new PaymentPlanResource($paymentPlan);
    }
}
