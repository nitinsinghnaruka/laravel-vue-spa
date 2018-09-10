<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\Login;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except('authenticate');
    }

    /**
     * Authenticate.
     * 
     * @param  Login  $request
     * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function authenticate(Login $request)
    {
        // Authenticate user.
        if (auth()->attempt([
            'email'    => $request->email, 
            'password' => $request->password, 
        ])) {
            $user = auth()->user();

            // Set response.
            $response = [
                'status'  => true,
                'message' => 'Login successfully.',
                'user'    => $user->makeHidden('id'),
                'token'   => $user->createToken('SPA')->accessToken
            ];
        } else {
            // Set response.
            $response = [
                'status'  => false,
                'message' => 'The email or password is incorrect.',
                'user'    => null,
                'token'   => null,
                'email'   => $request->email
            ];
        }

        return response()->json($response, 200);
    }

    /**
     * Logout.
     * 
     * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function logout()
    {
        // Delete auth user OAuth access token.
        if (auth()->user()->OauthAccessToken()->delete()) {
            $response = [
                'status'  => true,
                'message' => 'Logout successfully.'
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => 'Logout failed. Try again!'
            ];
        }

        return response()->json($response, 200);
    }
}
