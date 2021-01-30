<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    public function index()
    {
        return OrderResource::collection(Order::paginate());
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
