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


    /**
     * get all account
     * @method GET
     * @return JsonResponse
     */
    public function index():JsonResponse
    {

        //get all account
        $data = $this->account->all();

        return  response()->json($data ,$data['statusCode']);

    }

    /**
     * find account by account_no field
     * @method GET
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        //find account
        $data = $this->account->find($id);
        return  response()->json($data ,$data['statusCode']);

    }

    /**
     * make new account with bank and user
     * @method POST
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        //store account
        $data = $this->account->create($request);

        return  response()->json($data ,$data['statusCode']);

    }

    /**
     *
     * update account
     * @method PATCH
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        //update account
        $data = $this->account->update($request,$id);
        return  response()->json($data ,$data['statusCode']);
    }


    /**
     * disable account
     * @method PATCH
     * @param $id
     * @return JsonResponse
     */
    public function disabled($id): JsonResponse
    {
        //disable account
        $data = $this->account->disabled($id);
        return  response()->json($data ,$data['statusCode']);

    }
    /**
     * enable account
     * @method PATCH
     * @param $id
     * @return JsonResponse
     */
    public function enabled($id): JsonResponse
    {
        //enable account
        $data = $this->account->enabled($id);
        return  response()->json($data ,$data['statusCode']);

    }

}
