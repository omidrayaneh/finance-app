<?php

namespace App\Repositories\Eloquent;

use App\Models\Account;
use App\Repositories\AccountInterface;
use Illuminate\Support\Facades\Validator;

class AccountRepository implements AccountInterface
{
    /**
     * get all accounts
     * @return array
     */
    public function all()
    {
        $accounts = Account::all();
        return [
            'accounts' => $accounts,
            'message' => 'Accounts successfully found',
            'statusCode' => 200,

        ];
    }

    public function create($data)
    {
        $inputs = $data->only([ 'account_type', 'bank_id','total_balance','status' ,'total_limited']);

        $rules=array(
            'bank_id' =>"required",
            'account_type' =>"required",
            'total_balance' =>"required",
            'total_limited' =>"required",
            'status' =>"required",
        );
        $validator=Validator::make($data->all(),$rules);
        if($validator->fails()){
            $data = $validator->errors();
            $responce = [
                'data' => $data,
                'message' => 'error created account',
                'statusCode' => 422,
            ];
            return  $responce;
        }
        else {
            $account = new Account();
            $account->account_no = Account::generateAccountNo();
            $account->account_type = $inputs['account_type'];
            $account->status = $inputs['status'];
            $account->total_balance = $inputs['total_balance'];
            $account->total_limited = $inputs['total_limited'];
            $account->bank_id = $inputs['bank_id'];
            $account->save();
            $responce = [
                'data' => $account,
                'message' => 'account successfully created',
                'statusCode' => 200,

            ];
            return  $responce;
        }


    }

    public function update($data, $id)
    {
        $account = $this->find($id);
        if($account['data'] == null)
            return $account;

        $rules=array(
            'account_type' =>"required",
            'total_balance' =>"required",
            'total_limited' =>"required",
            'status' =>"required",
        );

        $validator=Validator::make($data->all(),$rules);
        if($validator->fails()){
            $data = $validator->errors();

            $responce = [
                'data' => $data,
                'message' => 'error update account',
                'statusCode' => 400,
            ];
        }
        else {

            $account = $this->find($id);
            $account = $account['data'];
            $account->account_type = $data['account_type'];
            $account->total_balance = $data['total_balance'];
            $account->total_limited = $data['total_limited'];
            $account->status = $data['status'];
            $account->save();

            $responce = [
                'data' => $account,
                'message' => 'account successfully updated',
                'statusCode' => 200,

            ];
        }
        return $responce;

    }

    public function find($id)
    {
        $account = Account::where('account_no',$id)->first();
        if (empty($account)){
            return  [
                'data' => null,
                'message' => 'account not found!',
                'statusCode' => 422,

            ];
        }

        return   [
            'data' => $account,
            'message' => 'account  founded!',
            'statusCode' => 200,

        ];
    }

    public function disabled($id)
    {
        $account = $this->find($id);
        $accounts =  $account['data'];
        if ($accounts == null)
          return  $account;

        $accounts->status = 0;
        $accounts->save();

        return  [
            'data' =>  $accounts,
            'message' => 'account disabled',
            'statusCode' => 200,
        ];
    }

    public function enabled($id)
    {
        $account = $this->find($id);
        $accounts =  $account['data'];
        if ($accounts == null)
            return  $account;

        $accounts->status = 1;
        $accounts->save();

        return  [
            'data' =>  $accounts,
            'message' => 'account enabled',
            'statusCode' => 200,
        ];
    }
}
