<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
        if(!Auth::user()->is_admin) {
            return $this->showFromUser();
        }

        $builder = Notification::query();
        $builder->with('user:id,name');

        return NotificationResource::collection($builder->get());
    }

    public function showFromUser(User $user) {
        $this->authorize('view', $user);

        $builder = Notification::query();

        $builder->whereBelongsTo($user);

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
            'description',
            'type',
            'user_id'
        ]);

        // Create notification for specified user
        if(isset($data['user_id'])){
            $notification = Notification::create($data);

            return new NotificationResource($notification);
        }

        unset($data['user_id']);
        
        // Create notification for every user in the database
        DB::transaction(function() use ($data) {
            $builder = User::query();

            foreach ($builder->get('id') as $user) {
                $data['user_id'] = $user->id;

                Notification::insert($data);
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
}
