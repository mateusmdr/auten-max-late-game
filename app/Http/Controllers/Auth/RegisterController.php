<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\StoreUserRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::VERIFY;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, (new StoreUserRequest())->rules());
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm(Request $request)
    {
        $current_step = $request->route('step',1);
        
        switch($current_step) {
            case 1:
                return view('auth.register.register_1');
                break;
            case 2:
                return view('auth.register.register_2');
                break;
            case 3:
                return view('auth.register.register_3');
                break;
            default:
                return abort(404);
        }
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $current_step = $request->route('step',1);

        if($current_step == 1) {
            $this->validator($request->all())->validate();

            $request->session()->put('form',$request->all());
            return to_route('register', ['step' => 2]);
        }
        
        if($current_step == 2) {
            Validator::make($request->only(['eula']),[
                'eula' => 'required|in:true,on,1'
            ])->validate();

            $data = $request->session()->get('form');

            $this->validator($data)->validate();

            if($data === null) {
                return to_route('register');
            }

            event(new Registered($user = $this->create($data)));

            $this->guard()->login($user);

            if ($response = $this->registered($request, $user)) {
                return $response;
            }

            return $request->wantsJson()
                ? new JsonResponse([], 201)
                : redirect($this->redirectPath());
        }

        return abort(404);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return $user;
    }
}