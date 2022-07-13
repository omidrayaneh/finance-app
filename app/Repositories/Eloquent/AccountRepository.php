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
        //get all account and return to controller
        $accounts = Account::all();
        return [
            'accounts' => $accounts,
            'message' => 'Accounts successfully found',
            'statusCode' => 200,

        ];
    }

    public function create($data)
    {
        //validate account fields
        $inputs = $data->only([ 'account_type', 'bank_id','user_id','total_balance','status' ,'total_limited']);
        $rules=array(
            'bank_id' =>"required",
            'user_id' =>"required",
            'account_type' =>"required",
            'total_balance' =>"required",
            'total_limited' =>"required",
            'status' =>"required",
        );
        $validator=Validator::make($data->all(),$rules);
        if($validator->fails()){
            //return validate error message
            $data = $validator->errors();
            $responce = [
                'data' => $data,
                'message' => 'error created account',
                'statusCode' => 422,
            ];
            return  $responce;
        }
        else {

            //make account
            $account = new Account();
            $account->account_no = Account::generateAccountNo();
            $account->account_type = $inputs['account_type'];
            $account->status = $inputs['status'];
            $account->total_balance = $inputs['total_balance'];
            $account->total_limited = $inputs['total_limited'];
            $account->bank_id = $inputs['bank_id'];
            $account->user_id = $inputs['user_id'];
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
        //validate update fields
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
            //response error message
            $data = $validator->errors();

            $responce = [
                'data' => $data,
                'message' => 'error update account',
                'statusCode' => 400,
            ];
        }
        else {
            // update account
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
        // search account in database
        $account = Account::where('account_no',$id)->first();

        //return error message
        if (empty($account)){
            return  [
                'data' => null,
                'message' => 'account not found!',
                'statusCode' => 422,

            ];
        }
        // return account
        return   [
            'data' => $account,
            'message' => 'account  founded!',
            'statusCode' => 200,

        ];
    }

    public function disabled($id)
    {
        // get response account with message
        $account = $this->find($id);
        //get account from response
        $accounts =  $account['data'];

        //return not found message
        if ($accounts == null)
          return  $account;

        // disable account
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
        // get response account with message
        $account = $this->find($id);

        //get account from response
        $accounts =  $account['data'];

        //return not found message
        if ($accounts == null)
            return  $account;

        // enable account
        $accounts->status = 1;
        $accounts->save();

        return  [
            'data' =>  $accounts,
            'message' => 'account enabled',
            'statusCode' => 200,
        ];
    }
}
