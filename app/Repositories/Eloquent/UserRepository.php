<?php
namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\UserInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserRepository implements UserInterface
{

    public function all(): array
    {
        //get all user
        $users = User::all();
        return [
            'users' => $users,
            'message' => 'users successfully found',
            'statusCode' => 200,

        ];
    }

    public function create($data): array
    {
        //validate user fields
        $inputs = $data->only(['name', 'email', 'password','status' ,'address','city','phone','birthday']);

        $rules=array(
            'name'  =>"required|min:3|max:30",
            'email' =>"required|unique:users|min:5|max:30",
            'address' =>"required",
            'city' =>"required",
            'phone' =>"required",
            'birthday' =>"required",
            'password' =>"required|min:6",
            'status' =>"required",
        );
        $validator=Validator::make($data->all(),$rules);
        if($validator->fails()){
            //response error validate
            $data = $validator->errors();
            $responce = [
                'data' => $data,
                'message' => 'error created user',
                'statusCode' => 422,
            ];
            return  $responce;
        }
        else {
            //make user
            $user = new User();
            $user->name = $inputs['name'];
            $user->email = $inputs['email'];
            $user->status = $inputs['status'];
            $user->address = $inputs['address'];
            $user->city = $inputs['city'];
            $user->phone = $inputs['phone'];
            $user->birthday = $inputs['birthday'];
            $user->password =Hash::make($inputs['password']) ;
            $user->save();
            $responce = [
                'data' => $user,
                'message' => 'user successfully created',
                'statusCode' => 201,

            ];
            return  $responce;
        }


    }

    public function update($data, $id): array
    {
        //find user if id is true
        $user = $this->find($id);
        //id is not true
        if($user['data'] == null)
         return $user;

        //validate user update fields
        $rules=array(
            'email' => 'unique:users,email,'.$id,
            'name'  =>"required|min:3|max:30",
            'address' =>"required",
            'city' =>"required",
            'phone' =>"required",
            'birthday' =>"required",
            'status' =>"required",
        );

        $validator=Validator::make($data->all(),$rules);
        if($validator->fails()){

            //response validation error message
            $data = $validator->errors();

            $responce = [
                'data' => $data,
                'message' => 'error update user',
                'statusCode' => 400,
            ];
        }
        else {

            //update user
            $user = $this->find($id);
            $user = $user['data'];
            $user->name = $data['name'];
            $user->status = $data['status'];
            $user->email = $data['email'];
            $user->city = $data['city'];
            $user->phone = $data['phone'];
            $user->birthday = $data['birthday'];
            $user->status = $data['status'];

            if ($data['password'])
                $user->password = Hash::make($data['password']);

            $user->save();

            $responce = [
                'data' => $user,
                'message' => 'user successfully updated',
                'statusCode' => 200,

            ];
        }
        return $responce;

    }

    public function delete($id): array
    {

        // find user by id if id exist
        $user = $this->find($id);
        if (!$user['data'] )
            return $user;

        //soft delete user
        $user['data']->delete();

          return  [
              'data' =>  $user['data'],
              'message' => 'user deleted',
              'statusCode' => 200,
          ];
    }

    public function find($id)
    {
        // find user by id if id exist
        $user = User::where('id',$id)->first();
        if (empty($user)){
            return  [
                'data' => null,
                'message' => 'user not found!',
                'statusCode' => 422,

            ];
        }
        //id is true and response user
      return   [
            'data' => $user,
            'message' => 'user  founded!',
            'statusCode' => 200,

        ];
    }
}
