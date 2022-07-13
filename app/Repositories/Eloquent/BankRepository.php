<?php

namespace App\Repositories\Eloquent;


use App\Models\Bank;
use App\Repositories\BankInterface;
use Illuminate\Support\Facades\Validator;

class BankRepository implements BankInterface
{

    /**
     * get all accounts
     * @return array
     */
    public function all()
    {
        $banks = Bank::all();
        return [
            'accounts' => $banks,
            'message' => 'Banks successfully found',
            'statusCode' => 200,

        ];
    }

    public function create($data)
    {
        $inputs = $data->only([ 'name', 'branch','pin_code','phone_no']);

        $rules=array(
            'name' =>"required|unique:banks|min:5",
            'branch' =>"required|min:5",
            'pin_code' =>"required",
            'phone_no' =>"required",
        );
        $validator=Validator::make($data->all(),$rules);
        if($validator->fails()){
            $data = $validator->errors();
            $responce = [
                'data' => $data,
                'message' => 'error created bank',
                'statusCode' => 422,
            ];
            return  $responce;
        }
        else {

            $bank = new Bank();
            $bank->name =$inputs['name'] ;
            $bank->branch = $inputs['branch'];
            $bank->pin_code = $inputs['pin_code'];
            $bank->phone_no = $inputs['phone_no'];
            $bank->save();
            $responce = [
                'data' => $bank,
                'message' => 'bank successfully created',
                'statusCode' => 200,

            ];
            return  $responce;
        }


    }

    public function update($data, $id)
    {
        $bank = $this->find($id);
        if($bank['data'] == null)
            return $bank;

        $rules=array(
            'name' => 'required|unique:users,name,'.$id,
            'branch' =>"required",
            'pin_code' =>"required",
            'phone_no' =>"required",
        );

        $validator=Validator::make($data->all(),$rules);
        if($validator->fails()){
            $data = $validator->errors();

            $responce = [
                'data' => $data,
                'message' => 'error update bank',
                'statusCode' => 400,
            ];
        }
        else {

            $bank = $this->find($id);
            $bank = $bank['data'];
            $bank->name = $data['name'];
            $bank->branch = $data['branch'];
            $bank->pin_code = $data['pin_code'];
            $bank->phone_no = $data['phone_no'];
            $bank->save();

            $responce = [
                'data' => $bank,
                'message' => 'bank successfully updated',
                'statusCode' => 200,

            ];
        }
        return $responce;

    }

    public function find($id)
    {
        $bank = Bank::where('id',$id)->first();
        if (empty($bank)){
            return  [
                'data' => null,
                'message' => 'bank not found!',
                'statusCode' => 422,

            ];
        }

        return   [
            'data' => $bank,
            'message' => 'bank  founded!',
            'statusCode' => 200,

        ];
    }


}
