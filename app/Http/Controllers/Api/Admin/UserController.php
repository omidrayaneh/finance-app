<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class UserController extends Controller
{
    private $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }


    public function index(): JsonResponse
    {
        $data = $this->user->all();

        return  response()->json($data ,$data['status']);

    }
    public function show($id): JsonResponse
    {
        $data = $this->user->find($id);
        return  response()->json($data ,$data['status']);

    }

    public function store(Request $request): JsonResponse
    {
        $data = $this->user->create($request);

        return  response()->json($data ,$data['status']);

    }

    public function update(Request $request,$id): JsonResponse
    {
        $user = $this->user->update($request,$id);

        return  response()->json($user ,$user['status']);
    }

    public function destroy($id): JsonResponse
    {
        $data = $this->user->delete($id);
        return  response()->json($data , $data['status']);
    }
}
