<?php

namespace App\Repositories\Eloquent;

use App\Models\Transaction;
use App\Repositories\TransactionInterface;
use Illuminate\Support\Facades\Validator;

class TransactionRepository implements TransactionInterface
{

    private $account;

    public function __construct(AccountRepository $account)
    {
        $this->account = $account;
    }

    /**
     * create transaction and account_transaction table and update both of account amount
     * @param $account_id1
     * @param $account_id2
     * @param $amount
     * @return array
     */
    public function create($data): array
    {
        // request only should be accessible
        $inputs = $data->only(['amount', 'status','account_id1','account_id2']);

        $rules = array(
            'account_id1' => "required",
            'account_id2' => "required",
            'amount' => "required",
        );
        //validate params is exists
        $validator = Validator::make($data->all(), $rules);
        if ($validator->fails()) {
            $data = $validator->errors();
            $responce = [
                'data' => $data,
                'message' => 'error created transfer',
                'statusCode' => 422,
            ];
            return $responce;
        } else {

            /******************************** account 1 payment amount to account 2  ***************************/

            // get account 1 value
            $account_id1 = $this->account->find($inputs['account_id1']);

            //insert first transaction into transactions table
            $transfer1 = new Transaction();
            $transfer1->amount = -$inputs['amount'];
            $transfer1->cust_id = Transaction::generateTransactonCUST();

            // if find account transaction status is YES else NO
            if ($account_id1['data'])
                $transfer1->status = 'Yes';
            else
                $transfer1->status = 'No';
            $transfer1->save();

            //get account 1 value
            $account1 = $account_id1['data'];

            // if account 1 exist insert into account transaction pivot table
            if ($account1)
                $transfer1->accounts()->sync($account1->id);

            // update account 1 amount
            $bill = $account1->total_balance - $inputs['amount'] ;
            $account1->total_balance = $bill;
            $account1->save();


            /********************************   1   ***************************/

            /******************************** account 2 give payment amount from account 1  ***************************/

            // get account 2 value
            $account_id2 = $this->account->find($inputs['account_id2']);

            //insert second transaction into transactions table
            $transfer2 = new Transaction();
            $transfer2->amount = $inputs['amount'];
            $transfer2->cust_id = Transaction::generateTransactonCUST();

            // if find account transaction status is YES else NO again
            if ($account_id2['data'])
                $transfer2->status = 'Yes';
            else
                $transfer2->status = 'No';
            $transfer2->save();

            //get account 2 value
            $account2 = $account_id2['data'];

            // if account 2 exist insert into account transaction pivot table
            if ($account2)
                $transfer2->accounts()->sync($account2->id);

            // update account 1 amount
            $bill2 = $account2->total_balance + $inputs['amount'] ;
            $account2->total_balance = $bill2;
            $account2->save();

            /********************************   2   ***************************/


            $responce = [
                'data' => [$transfer1,$transfer2],
                'message' => 'transfers successfully created',
                'statusCode' => 200,

            ];
            return $responce;
        }


    }

    /**
     * return exist transaction with account pivot data
     * @param $id
     * @return array
     */
    function find($id): array
    {
        //find transaction with relation (accounts)
        $account = Transaction::with('accounts')->where('cust_id', $id)->first();

        // if transaction not fount return 422 status code
        if (empty($account)) {
            return [
                'data' => null,
                'message' => 'transaction not found!',
                'statusCode' => 422,

            ];
        }

        // if transaction is existed return it
        return [
            'data' => $account,
            'message' => 'transaction  founded!',
            'statusCode' => 200,

        ];

    }
}
