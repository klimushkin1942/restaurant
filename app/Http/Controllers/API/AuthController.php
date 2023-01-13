<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    public function signin(Request $request)
    {
        if (Auth::attempt(['login' => $request->login, 'password' => $request->password])) {
            $authUser = Auth::user();
            $success['token'] = $authUser->createToken('restaurantAPI')->plainTextToken;
            $success['name'] = $authUser->name;

            return $this->sendResponse($success, 'User signed in');
        } else {
            return $this->sendError('Unauthorized', ['error' => 'Unauthorized']);
        }
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required',
            'pinCode' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('restaurantAPI')->plainTextToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User created successfully.');
    }
}
