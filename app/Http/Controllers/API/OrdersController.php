<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdersController extends BaseController
{
    use ApiHelpers;
    public function index(Request $request)
    {
        if ($this->isAdmin($request->user())) {
            $orders = Order::all();
            return $this->sendResponse(OrderResource::collection($orders), 'Orders fetched.');
        } else {
            return $this->sendError('You are is not admin', ['error' => 'Not permissions']);
        }
    }

    public function store(Request $request)
    {
        if ($this->isAdmin($request->user())) {
            $input = $request->all();
            $validator = Validator::make($input, [
                'isClose' => 'required',
            ]);
            if($validator->fails()){
                return $this->sendError($validator->errors());
            }
            $order = Order::create($input);
            return $this->sendResponse(new OrderResource($order), 'Order created.');
        } else {
            return $this->sendError('You are is not admin', ['error' => 'Not permissions']);
        }
    }

    public function show(Request $request, $id)
    {
        if ($this->isAdmin($request->user())) {
            $order = Order::find($id);
            if (is_null($order)) {
                return $this->sendError('Order does not exist.');
            }
            return $this->sendResponse(new OrderResource($order), 'Order fetched.');
        } else {
            return $this->sendError('You are is not admin', ['error' => 'Not permissions']);
        }
    }

    public function update(Request $request, $id)
    {
        if ($this->isAdmin($request->user())) {
            $input = $request->all();
            $order = Order::find($id);

            $validator = Validator::make($input, [
                'isClose' => 'required',
            ]);

            if($validator->fails()){
                return $this->sendError($validator->errors());
            }

            $order->isClose = $input['isClose'];
            $order->save();

            return $this->sendResponse(new OrderResource($order), 'Order updated.');
        } else {
            return $this->sendError('You are is not admin', ['error' => 'Not permissions']);
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($this->isAdmin($request->user())) {
            $order = Order::find($id);
            $order->delete();
            return $this->sendResponse([], 'Order deleted.');
        } else {
            return $this->sendError('You are is not admin', ['error' => 'Not permissions']);
        }
    }

}
