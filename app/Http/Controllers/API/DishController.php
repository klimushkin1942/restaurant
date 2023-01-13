<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\DishResource;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DishController extends BaseController
{
    use ApiHelpers;
    public function index()
    {
        $dishes = Dish::all();
        return $this->sendResponse(DishResource::collection($dishes), 'Dishes fetched.');
    }

    public function store(Request $request)
    {
        if ($this->isAdmin($request->user())) {
            $input = $request->all();
            $validator = Validator::make($input, [
                'category_id'  => 'required',
                'name_dish' => 'required',
                'composition' => 'required',
                'price' => 'required',
                'calories' => 'required',
                'img_src' => 'required',
            ]);
            if($validator->fails()){
                return $this->sendError($validator->errors());
            }
            $dish = Dish::create($input);
            return $this->sendResponse(new DishResource($dish), 'Dish created.');
        } else {
            return $this->sendError('You are is not admin', ['error' => 'Not permissions']);
        }
    }

    public function show(Request $request, $id)
    {
        if ($this->isAdmin($request->user())) {
            $dish = Dish::find($id);
            if (is_null($dish)) {
                return $this->sendError('Dish does not exist.');
            }
            return $this->sendResponse(new DishResource($dish), 'Dish fetched.');
        } else {
            return $this->sendError('You are is not admin', ['error' => 'Not permissions']);
        }
    }

    public function update(Request $request, $id)
    {
        if ($this->isAdmin($request->user())) {
            $input = $request->all();
            $dish = Dish::find($id);

            $validator = Validator::make($input, [
                'category_id'  => 'required',
                'name_dish' => 'required',
                'composition' => 'required',
                'price' => 'required',
                'calories' => 'required',
                'img_src' => 'required',
            ]);

            if($validator->fails()){
                return $this->sendError($validator->errors());
            }

            $dish->category_id = $input['category_id'];
            $dish->name_dish = $input['name_dish'];
            $dish->composition = bcrypt($input['composition']);
            $dish->price = $input['price'];
            $dish->calories = $input['calories'];
            $dish->img_src = $input['img_src'];
            $dish->save();

            return $this->sendResponse(new DishResource($dish), 'Dish updated.');
        } else {
            return $this->sendError('You are is not admin', ['error' => 'Not permissions']);
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($this->isAdmin($request->user())) {
            $dish = Dish::find($id);
            $dish->delete();
            return $this->sendResponse([], 'Dish deleted.');
        } else {
            return $this->sendError('You are is not admin', ['error' => 'Not permissions']);
        }
    }
}
