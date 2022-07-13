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


    /**
     * get all bank
     * @method GET
     * @return JsonResponse
     */
    public function index():JsonResponse
    {
        //get all account
        $data = $this->bank->all();

        return  response()->json($data ,$data['statusCode']);

    }

    /**
     * find bank by id
     * @method GET
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        //find bank
        $data = $this->bank->find($id);
        return  response()->json($data ,$data['statusCode']);

    }

    /**
     * make new bank
     * @method POST
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        //store bank
        $data = $this->bank->create($request);

        return  response()->json($data ,$data['statusCode']);

    }

    /**
     * edit bank by id
     * @method PATCH
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        //update bank
        $data = $this->bank->update($request,$id);
        return  response()->json($data ,$data['statusCode']);
    }


}
