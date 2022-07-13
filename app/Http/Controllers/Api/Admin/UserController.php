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


    /**
     * get all users
     * @method GET
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        //get all user
        $data = $this->user->all();

        return  response()->json($data ,$data['statusCode']);

    }

    /**
     * find user by id
     * @method GET
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        //find user
        $data = $this->user->find($id);
        return  response()->json($data ,$data['statusCode']);

    }

    /**
     * make user by admin
     * @method GET
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        //store user
        $data = $this->user->create($request);

        return  response()->json($data ,$data['statusCode']);

    }


    /**
     * update user field
     * @method PATCH
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        //update user
        $data = $this->user->update($request,$id);
        return  response()->json($data ,$data['statusCode']);
    }


    /**
     * soft delete user
     * @method POST
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        // soft delete user
        $data = $this->user->delete($id);
        return  response()->json($data , $data['statusCode']);
    }
}
