<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    use ApiHelpers;
    public function index(Request $request)
    {
        if ($this->isAdmin($request->user())) {
            $users = User::all();
            return $this->sendResponse(UserResource::collection($users), 'Users fetched.');
        } else {
            return $this->sendError('You are is not admin', ['error' => 'Not permissions']);
        }
    }

    public function store(Request $request)
    {
        if ($this->isAdmin($request->user())) {
            $input = $request->all();
            $validator = Validator::make($input, [
                'name' => 'required',
                'login' => 'required',
                'password' => 'required',
                'pinCode' => 'required',
                'isAdmin' => 'required'
            ]);
            if($validator->fails()){
                return $this->sendError($validator->errors());
            }
            $user = User::create($input);
            return $this->sendResponse(new UserResource($user), 'User created.');
        } else {
            return $this->sendError('You are is not admin', ['error' => 'Not permissions']);
        }
    }

    public function show(Request $request, $id)
    {
        if ($this->isAdmin($request->user())) {
            $user = User::find($id);
            if (is_null($user)) {
                return $this->sendError('User does not exist.');
            }
            return $this->sendResponse(new UserResource($user), 'User fetched.');
        } else {
            return $this->sendError('You are is not admin', ['error' => 'Not permissions']);
        }
    }

    public function update(Request $request, $id)
    {
        if ($this->isAdmin($request->user())) {
            $input = $request->all();
            $user = User::find($id);

            $validator = Validator::make($input, [
                'name' => 'required',
                'login' => 'required',
                'password' => 'required',
                'pinCode' => 'required',
            ]);

            if($validator->fails()){
                return $this->sendError($validator->errors());
            }

            $user->name = $input['name'];
            $user->login = $input['login'];
            $user->password = bcrypt($input['password']);
            $user->pinCode = $input['pinCode'];
            $user->isAdmin = $input['isAdmin'];
            $user->save();

            return $this->sendResponse(new UserResource($user), 'User updated.');
        } else {
            return $this->sendError('You are is not admin', ['error' => 'Not permissions']);
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($this->isAdmin($request->user())) {
            $user = User::find($id);
            $user->delete();
            return $this->sendResponse([], 'User deleted.');
        } else {
            return $this->sendError('You are is not admin', ['error' => 'Not permissions']);
        }
    }
}
