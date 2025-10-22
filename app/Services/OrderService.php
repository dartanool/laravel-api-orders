<?php

namespace App\Services;

use App\DTOs\OrderDTO;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderService
{
    public function getOrders(OrderDTO $orderDTO){

        $dateFrom = $orderDTO->dateFrom;
        $dateTo = $orderDTO->dateTo;
        $page = $orderDTO->page;
        $limit = $orderDTO->limit;

        $query = Order::query();

        if ($dateFrom) {
            if (strlen($dateFrom) === 10) {
                $dateFrom .= ' 00:00:00';
            }
            $query->where('created_at', '>=', $dateFrom);
        }

        if ($dateTo) {
            if (strlen($dateTo) === 10) {
                $dateTo .= ' 23:59:59';
            }
            $query->where('created_at', '<=', $dateTo);
        }

        // Пагинация
        $orders = $query->orderBy('created_at', 'desc')
            ->paginate($limit, ['*'], 'page', $page);

        return $orders;
    }
}
