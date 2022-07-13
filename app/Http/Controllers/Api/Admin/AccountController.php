<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\AccountRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    private $account;

    public function __construct(AccountRepository $account)
    {
        $this->account = $account;
    }



    public function index():JsonResponse
    {
        $data = $this->account->all();

        return  response()->json($data ,$data['statusCode']);

    }
    public function show($id): JsonResponse
    {
        $data = $this->account->find($id);
        return  response()->json($data ,$data['statusCode']);

    }
    public function store(Request $request): JsonResponse
    {
        $data = $this->account->create($request);

        return  response()->json($data ,$data['statusCode']);

    }

    public function update(Request $request,$id): JsonResponse
    {
        $data = $this->account->update($request,$id);
        return  response()->json($data ,$data['statusCode']);
    }

    public function disabled($id)
    {
        $data = $this->account->disabled($id);
        return  response()->json($data ,$data['statusCode']);

    }
    public function enabled($id)
    {
        $data = $this->account->enabled($id);
        return  response()->json($data ,$data['statusCode']);

    }

}
