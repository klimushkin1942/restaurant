<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\OrderItemsResource;
use Illuminate\Http\Request;
use App\Models\OrderItems;
use Illuminate\Support\Facades\Validator;

class OrderItemController extends BaseController
{
    use ApiHelpers;
    public function index(Request $request)
    {
        if ($this->isAdmin($request->user())) {
            $orderItems = OrderItems::all();
            return $this->sendResponse(OrderItemsResource::collection($orderItems), 'OrderItems fetched.');
        } else {
            return $this->sendError('You are is not admin', ['error' => 'Not permissions']);
        }
    }

    public function store(Request $request)
    {
        if ($this->isAdmin($request->user())) {
            $input = $request->all();
            $validator = Validator::make($input, [
                'orders_id' => 'required',
                'dishes_id' => 'required',
                'count' => 'required'
            ]);
            if($validator->fails()){
                return $this->sendError($validator->errors());
            }
            $orderItem = OrderItems::create($input);
            return $this->sendResponse(new OrderItemsResource($orderItem), 'OrderItem created.');
        } else {
            return $this->sendError('You are is not admin', ['error' => 'Not permissions']);
        }
    }

    public function show(Request $request, $id)
    {
        if ($this->isAdmin($request->user())) {
            $orderItem = OrderItem::find($id);
            if (is_null($orderItem)) {
                return $this->sendError('OrderItem does not exist.');
            }
            return $this->sendResponse(new OrderItemResource($orderItem), 'OrderItem fetched.');
        } else {
            return $this->sendError('You are is not admin', ['error' => 'Not permissions']);
        }
    }

    public function update(Request $request, $id)
    {
        if ($this->isAdmin($request->user())) {
            $input = $request->all();
            $orderItem = OrderItem::find($id);

            $validator = Validator::make($input, [
                'orders_id' => 'required',
                'dishes_id' => 'required',
                'count' => 'required'
            ]);

            if($validator->fails()){
                return $this->sendError($validator->errors());
            }

            $orderItem->orders_id = $input['orders_id'];
            $orderItem->dishes_id = $input['dishes_id'];
            $orderItem->count = $input['count'];
            $orderItem->save();

            return $this->sendResponse(new OrderItemResource($orderItem), 'OrderItem updated.');
        } else {
            return $this->sendError('You are is not admin', ['error' => 'Not permissions']);
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($this->isAdmin($request->user())) {
            $order = OrderItem::find($id);
            $order->delete();
            return $this->sendResponse([], 'OrderItem deleted.');
        } else {
            return $this->sendError('You are is not admin', ['error' => 'Not permissions']);
        }
    }
}
