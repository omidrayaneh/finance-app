<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\BankRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BankController extends Controller
{
    private $bank;

    public function __construct(BankRepository $bank)
    {
        $this->bank = $bank;
    }



    public function index():JsonResponse
    {
        $data = $this->bank->all();

        return  response()->json($data ,$data['statusCode']);

    }
    public function show($id): JsonResponse
    {
        $data = $this->bank->find($id);
        return  response()->json($data ,$data['statusCode']);

    }
    public function store(Request $request): JsonResponse
    {
        $data = $this->bank->create($request);

        return  response()->json($data ,$data['statusCode']);

    }

    public function update(Request $request,$id): JsonResponse
    {
        $data = $this->bank->update($request,$id);
        return  response()->json($data ,$data['statusCode']);
    }


}
