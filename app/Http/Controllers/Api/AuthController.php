<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {

    }

    /**
     * Create Usr
     * @param LoginRequest $request
     * return User
     */
    public function login(LoginRequest $request)
    {

    }
}
