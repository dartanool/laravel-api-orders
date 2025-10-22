<?php

namespace App\Services;

use App\DTOs\OrderDTO;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderService
{
    public function getOrders(OrderDTO $dto){

        $query = Order::query();

        if ($dto->dateFrom) {
            $query->where('created_at', '>=', $dto->dateFrom);
        }

        if ($dto->dateTo) {
            $query->where('created_at', '<=', $dto->dateTo);
        }

        // Пагинация
        $orders = $query->orderBy('created_at', 'desc')
            ->paginate($dto->limit, ['*'], 'page', $dto->page);

        return $orders;
    }
}
