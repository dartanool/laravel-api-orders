<?php

namespace App\Services;

use App\DTOs\StockDTO;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockService
{
    public function getStocks(StockDTO $dto){
        $query = Stock::query();

        if ($dto->dateFrom) {
            $query->whereDate('created_at', '>=', $dto->dateFrom);
        }

        // Пагинация
        $stocks = $query->orderBy('created_at', 'desc')
            ->paginate($dto->limit, ['*'], 'page', $dto->page);

        return $stocks;
    }

}
