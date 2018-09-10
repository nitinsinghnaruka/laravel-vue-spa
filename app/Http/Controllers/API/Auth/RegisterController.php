<?php

namespace App\Http\Controllers\API\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\Register;

class RegisterController extends Controller
{
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
     * Create a new user instance after a valid registration.
     *
     * @param  Register  $request
     * @return \App\User
     */
    protected function create(Register $request)
    {
        // Store user.
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // Set response.
        if ($user->exists()) {
            $response = [
                'status'  => true,
                'message' => 'Registration successful. Logged in!',
                'user'    => $user->makeHidden('id'),
                'token'   => $user->createToken('SPA')->accessToken
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => 'Account creating failed.',
                'user'    => null,
                'token'   => null
            ];
        }

        return response()->json($response, 200);
    }
}
