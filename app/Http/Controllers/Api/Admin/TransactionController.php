<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\TransactionRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $transfer;

    public function __construct(TransactionRepository $transfer)
    {
        $this->transfer = $transfer;
    }

    /**
     * make new transaction
     * send amount from account to another account
     * @method POST
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request):JsonResponse
    {
        //store transaction
        $data = $this->transfer->create($request);

        return  response()->json($data ,$data['statusCode']);
    }

    /**
     * find  transaction by cust_id
     * @method GET
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        //find transaction
        $data = $this->transfer->find($id);
        return  response()->json($data ,$data['statusCode']);

    }
}
