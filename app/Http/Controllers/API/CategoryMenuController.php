<?php

namespace App\Http\Controllers\API;
use App\Models\CategoryMenu;
use App\Http\Resources\CategoryMenuResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryMenuController extends BaseController
{
    use ApiHelpers;
    public function index(Request $request)
    {
        if ($this->isAdmin($request->user())) {
            $categories = CategoryMenu::all();
            return $this->sendResponse(CategoryMenuResource::collection($categories), 'Categories fetched.');
        } else {
            return $this->sendError('You are is not admin', ['error' => 'Not permissions']);
        }
    }

    public function store(Request $request)
    {
        if ($this->isAdmin($request->user())) {
            $input = $request->all();
            $validator = Validator::make($input, [
                'category_name' => 'required',
                'img_src' => 'required'
            ]);
            if($validator->fails()){
                return $this->sendError($validator->errors());
            }
            $categoryMenu = CategoryMenu::create($input);
            return $this->sendResponse(new CategoryMenuResource($categoryMenu), 'Category created.');
        } else {
            return $this->sendError('You are is not admin', ['error' => 'Not permissions']);
        }
    }

    public function show(Request $request, $id)
    {
        if ($this->isAdmin($request->user())) {
            $categoryMenu = CategoryMenu::find($id);
            if (is_null($categoryMenu)) {
                return $this->sendError('Category does not exist.');
            }
            return $this->sendResponse(new CategoryMenuResource($categoryMenu), 'Category fetched.');
        } else {
            return $this->sendError('You are is not admin', ['error' => 'Not permissions']);
        }
    }

    public function update(Request $request, $id)
    {
        if ($this->isAdmin($request->user())) {
            $input = $request->all();
            $categoryMenu = CategoryMenu::find($id);

            $validator = Validator::make($input, [
                'category_name' => 'required',
                'img_src' => 'required'
            ]);

            if($validator->fails()){
                return $this->sendError($validator->errors());
            }

            $categoryMenu->category_name = $input['category_name'];
            $categoryMenu->img_src = $input['img_src'];
            $categoryMenu->save();

            return $this->sendResponse(new CategoryMenuResource($categoryMenu), 'Category updated.');
        } else {
            return $this->sendError('You are is not admin', ['error' => 'Not permissions']);
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($this->isAdmin($request->user())) {
            $categoryMenu = CategoryMenu::find($id);
            $categoryMenu->delete();
            return $this->sendResponse([], 'Category deleted.');
        } else {
            return $this->sendError('You are is not admin', ['error' => 'Not permissions']);
        }
    }
}
