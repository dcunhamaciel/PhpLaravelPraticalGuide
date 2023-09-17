<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems')->paginate();

        return OrderResource::collection($orders);
    }

    public function show($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);

        return new OrderResource($order);
    }

    public function export()
    {
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attatchment; filename=orders.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () {
            $orders = Order::all();
            $file = fopen('php://output', 'w');

            fputcsv($file, ['ID', 'Name', 'Email', 'Product Title', 'Price', 'Quantity']);

            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->id, 
                    $order->name, 
                    $order->email, 
                    '', 
                    '', 
                    ''
                ]);

                foreach ($order->orderItems as $item) {
                    fputcsv($file, [
                        '', 
                        '', 
                        '', 
                        $item->product_title, 
                        $item->price, 
                        $item->quantity
                    ]);                    
                }
            }

            fclose($file);
        };

        return response()->stream($callback, Response::HTTP_OK, $headers);
    }
}
