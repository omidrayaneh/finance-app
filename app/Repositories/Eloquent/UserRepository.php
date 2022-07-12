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
        $users = User::all();
        $responce = [
            'users' => $users,
            'message' => 'users successfully found',
            'status' => 200,

        ];
        return  $responce;
    }

    public function create($data): array
    {
        $inputs = $data->only(['name', 'email', 'password','status']);

        $rules=array(
            'name'  =>"required|min:3|max:30",
            'email' =>"required|unique:users|min:5|max:30",
            'password' =>"required|min:6",
            'status' =>"required",
        );
        $validator=Validator::make($data->all(),$rules);
        if($validator->fails()){
            $data = $validator->errors();
            $responce = [
                'user' => $data,
                'message' => 'error created user',
                'code' => 404,
            ];
            return  $responce;
        }
        else {
            $user = new User();
            $user->name = $inputs['name'];
            $user->email = $inputs['email'];
            $user->status = $inputs['status'];
            $user->password =Hash::make($inputs['password']) ;
            $user->save();
            $responce = [
                'user' => $user,
                'message' => 'user successfully created',
                'code' => 200,

            ];
            return  $responce;
        }


    }

    public function update($data, $id): array
    {
       // $inputs = $data->only(['name','email' ,'status','id']);
        $user = $this->find($id);
        $rules=array(
            'id'  =>"required",
            'name'  =>"required|min:3|max:30",
            'email' => 'unique:users,email,'.$user->id,
            'status' =>"required",
        );

        $validator=Validator::make($data->all(),$rules);
        if($validator->fails()){
            $data = $validator->errors();

            $responce = [
                'user' => $data,
                'message' => 'error update user',
                'status' => 400,
            ];
        }
        else {
            $user = $this->find($id);
            $user->name = $data['name'];
            $user->status = $data['status'];
            $user->email = $data['email'];

            if ($data['password'])
                $user->password = Hash::make($data['password']);

            $user->save();

            $responce = [
                'user' => $user,
                'message' => 'user successfully created',
                'status' => 200,

            ];
        }
        return $responce;

    }

    public function delete($id): array
    {
        $user = $this->find($id);
        if (!$user['user'] ){
            $responce = $user;
            return $responce;
        }

        $user['user'] ->delete();

        $responce = $user;
        return $responce;

    }

    public function find($id)
    {
        $user = User::where('id',$id)->first();
        if (empty($user)){
            $responce = [
                'user' => $user,
                'message' => 'user not found',
                'status' => 422,

            ];
            return $responce;
        }

        $responce = [
            'user' => $user,
            'message' => 'user found successfully',
            'status' => 200,

        ];
        return $responce;
    }
}
