<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\ChangePaymentPlanRequest;
use App\Models\PaymentPlan;

class UserController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $builder = User::query();
        $builder->where('is_admin',false);
        $builder->orderBy('name');
        $builder->with('payment_plan:id,name,period');

        return UserResource::collection($builder->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->only([
            'email',
            'password',
            'cpf',
            'name',
            'phone',
        ]);
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->only([
            'email',
            'name',
            'cpf',
            'phone',
        ]);
        
        if(!empty($data)) {
            $user->update($data);
            $user->save();
        }

        return new UserResource($user);
    }

    public function changePaymentPlan(ChangePaymentPlanRequest $request, User $user)
    {
        $data = $request->only(['period', 'method']);

        if(empty($data)) {
            return;
        }

        if(!empty($data['period'])) {
            $builder = PaymentPlan::query()->where('period', $data['period']);

            $user->payment_plan()->associate($builder->first());
        }

        if(!empty($data['method'])) {
            $user->payment_method = $data['method'];
        }

        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        return $user->deleteOrFail();
    }
}
