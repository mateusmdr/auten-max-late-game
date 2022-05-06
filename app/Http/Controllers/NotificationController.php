<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\NotificationResource;
use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;

class NotificationController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Notification::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $builder = Notification::query();
        // $builder->with('users');

        return NotificationResource::collection($builder->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotificationRequest $request)
    {
        $data = $request->only([
            'datetime',
            'message',
            'type',
            'user_id'
        ]);

        // Create notification for specified user
        if(!is_null($data['user_id'])){
            $notification = new Notification($data);

            return new NotificationResource($notification);
        }

        unset($data['user_id']);
        
        // Create notification for every user in the database
        DB::transaction(function() use ($data) {
            $builder = User::query();

            foreach ($builder->get('id') as $userId) {
                $data['user_id'] = $userId;

                User::insert($data);
            }
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        return new NotificationResource($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        $notification->delete();
    }

    public function showFromUser(User $user) {
        $this->authorize('viewAny', Notification::class);
        $this->authorize('view', $user);

        $builder = Notification::query();

        $builder->whereBelongsTo($user);

        return NotificationResource::collection($builder->get());
    }
}
