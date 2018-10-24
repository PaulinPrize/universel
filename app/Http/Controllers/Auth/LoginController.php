<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use \BeyondCode\EmailConfirmation\Traits\AuthenticatesUsers;
        
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'tableau-de-bord';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function update_cover($cover,$token)
    {
        DB::table('users')
            ->where('id', $token)
            ->update(['photo' => $cover]);
    }
}
