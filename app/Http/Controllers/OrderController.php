<?php

namespace App\Http\Controllers;

use App\DTOs\OrderDTO;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        private OrderService $orderService
    ){}
    public function index(Request $request){
        $dto = new OrderDTO($request);

        if ($dto->key !== env('API_KEY')) {
            return response()->json(['error'=> 'Unauthorized']);
        }

        $orders = $this->orderService->getOrders($dto);

        return response()->json($orders);
    }

}
