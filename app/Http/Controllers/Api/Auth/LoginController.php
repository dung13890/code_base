<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Contracts\Services\PassportInterface;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends ApiController
{
    use AuthenticatesUsers;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login(Request $request, PassportInterface $service)
    {
        if ($this->attemptLogin($request)) {
            $response = $request->has('refresh_token') ? $service->refreshGrantToken($request->refresh_token)
                : $service->passwordGrantToken($request->only(['email', 'password']));
            
            if (isset($response->error)) {
                throw new \Exception($response->message, 404);
            } elseif (isset($response->access_token)) {
                $this->compacts['passport'] = $response;
            }
        } else {
            throw new \Exception(__('auth.failed'), 401);
        }

        return $this->jsonRender();
    }
}
