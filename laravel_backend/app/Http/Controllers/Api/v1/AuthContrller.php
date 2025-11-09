<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthContrller extends Controller
{
    use ApiResponses;
    public function login(LoginUserRequest $request)
    {
        
        $request->validate($request->all());

        if(!Auth::attempt($request->only('email','password'))){
            return $this->error('Invalid Credentials', 401);
        }

        $user= User::firstwhere('email', $request->email);

        return $this->ok(
            'Authenticated',
            [
                'token'=>$user->cerateToken(
                    'API token for ' . $user->email,
                    ['*'],
                    now()->AddMonth())->plainTextToken
            ]
        );
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        
        return $this->k('Loggeg out successful');

    }

    public function register(RegisterUserRequest $request)
    {
        $data = $request->validated();

        $user =User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
        ]);

        return $this->ok(
            'user registered successfully',
        );
    }
}
















































































































































