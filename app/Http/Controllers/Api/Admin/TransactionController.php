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

    public function store(Request $request):JsonResponse
    {
        $data = $this->transfer->create($request);

        return  response()->json($data ,$data['statusCode']);
    }
}
