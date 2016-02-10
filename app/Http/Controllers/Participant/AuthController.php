<?php

namespace App\Http\Controllers\Participant;

use App\Models\Country;
use App\User;
use App\Jobs\UploadCVForParticipant;
use Illuminate\Http\Request;
use App\Models\Participant;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

/**
 * Class AuthController
 * @package App\Http\Controllers\Participant
 */
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Where to redirect user to login
     *
     * @var string
     */
    protected $loginPath = '/login';

    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name'    => 'required|max:255',
            'last_name'     => 'required|max:255',
            'country_id'    => 'required',
            'email'         => 'required|email|max:255|unique:users,role',
            'password'      => 'required|confirmed|min:6',
            'phone_number'  => 'required',
            'city'          => 'required',
            'skype_name'    => 'max:255',
            'cv_file'       => 'required|mimes:doc,docx,ood,pdf,txt|max:8192'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    /**
     * @param array $data
     * @return bool
     */
    protected function create(array $data)
    {
        try {

            app('db')->beginTransaction();

            $user = User::create([
                'first_name'    => $data['first_name'],
                'last_name'     => $data['last_name'],
                'email'         => $data['email'],
                'password'      => bcrypt($data['password']),
            ]);

            $participant = Participant::create([
                'user_id'   =>  $user->getKey(),
                'country_id'    =>  $data['country_id'],
                'city'          =>  $data['city'],
                'phone_number'  =>  $data['phone_number'],
                'skype_name'    =>  $data['skype_name']
            ]);

            $this->dispatch(new UploadCVForParticipant($participant, $data['cv_file']));

            app('db')->commit();

            return $user;

        } catch (\Exception $e) {

            app('db')->rollback();

            logger()->error($e->getMessage(), [
                'data'  =>  $data
            ]);

            return null;
        }
    }



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRegister()
    {
        return view('participant.auth.register', ['countries' =>  Country::all(), 'TITLE'   => 'Register']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin()
    {
        return view('participant.auth.login', ['TITLE'  => 'Login']);
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return array_merge($request->only($this->loginUsername(), 'password'), ['role' => User::ROLE_PARTICIPANT]);
    }
}
