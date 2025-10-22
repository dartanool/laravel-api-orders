<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        private OrderService $orderService
    ){}
    public function index(Request $request){
        $key = $request->query('key');

        if ($key !== env('API_KEY')) {
            return response()->json(['error'=> 'Unauthorized']);
        }

        $orders = $this->orderService->getOrders($request);

        return response()->json($orders);
    }

}
