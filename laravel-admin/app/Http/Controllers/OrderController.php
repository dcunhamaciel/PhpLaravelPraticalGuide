<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItem')->paginate();

        return OrderResource::collection($orders);
    }

    public function show($id)
    {
        $order = Order::with('orderItem')->findOrFail($id);

        return new OrderResource($order);
    }
}
