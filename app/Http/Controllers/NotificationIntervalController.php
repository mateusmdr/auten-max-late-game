<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotificationInterval;
use App\Http\Resources\NotificationIntervalResource;
use App\Http\Requests\StoreNotificationIntervalRequest;

class NotificationIntervalController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(NotificationInterval::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $builder = NotificationInterval::query();
        $builder->orderBy('minutes');

        return NotificationIntervalResource::collection($builder->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotificationIntervalRequest $request)
    {
        $data = $request->only(['minutes']);

        $notificationInterval = NotificationInterval::create($data);

        return new NotificationIntervalResource($notificationInterval);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NotificationInterval  $notificationInterval
     * @return \Illuminate\Http\Response
     */
    public function show(NotificationInterval $notificationInterval)
    {
        return new NotificationIntervalResource($notificationInterval);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NotificationInterval  $notificationInterval
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotificationInterval $notificationInterval)
    {
        $notificationInterval->delete();
    }
}
