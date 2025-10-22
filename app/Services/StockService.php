<?php

namespace App\Services;

use App\DTOs\StockDTO;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockService
{
    public function getStocks(StockDTO $dto){
        $dateFrom = $dto->dateFrom;
        $page = $dto->page;
        $limit = $dto->limit;

        $query = Stock::query();

        if ($dateFrom) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }

        // Пагинация
        $stocks = $query->orderBy('created_at', 'desc')
            ->paginate($limit, ['*'], 'page', $page);

        return $stocks;
    }

}
