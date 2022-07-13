<?php

namespace App\Repositories\Eloquent;

use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;

class TransactionRepository implements \App\Repositories\TransactionInterface
{

    private $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function create($data)
    {
        $inputs = $data->only([ 'amount', 'status','user_id']);

        $rules=array(
            'user_id' =>"required",
            'amount' =>"required",
            'status' =>"required",
        );
        $validator=Validator::make($data->all(),$rules);
        if($validator->fails()){
            $data = $validator->errors();
            $responce = [
                'data' => $data,
                'message' => 'error created transfer',
                'statusCode' => 422,
            ];
            return  $responce;
        }
        else {

           $user =  $this->user->find($inputs['user_id']);

            $transfer = new Transaction();
            $transfer->amount =$inputs['amount'] ;
            $transfer->cust_id = Transaction::generateTransactonCUST();

            if ($user['data'])
                $transfer->status = 'Yes';

            else
                $transfer->status = 'No';
            $transfer->save();


            if ($user['data'])
            $transfer->accounts()->sync($inputs['user_id']);




            $responce = [
                'data' => $transfer,
                'message' => 'transfer successfully created',
                'statusCode' => 200,

            ];
            return  $responce;
        }


    }
}
