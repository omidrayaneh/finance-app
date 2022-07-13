<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * register new user
     * @method post
     * @param Request $request
     */
    public function register(Request $request)
    {

        // validate Input params
        $request->validate([
            'name' =>['required' ],
            'email' =>['required' , 'email', 'unique:users'],
            'password' =>['required'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make( $request->password),
        ]);

        return response()->json(['message' => 'user create successfully'],201);
    }

    /**
     * login user
     * @method post
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request): JsonResponse
    {
        // validate Input params
        $request->validate([
            'email' =>['required' , 'email'],
            'password' =>['required'],
        ]);

        //check user credential for login
        if (Auth::attempt($request->only(['email','password']))){
            return response()->json(Auth::user(),200);
        }

        throw ValidationException::withMessages([
            'email' => 'incorrect credentials.'
        ]);
    }

    /**
     * user logout
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::logout();
        return response()->json(['message'=>'user logged out'],200);
    }
}
