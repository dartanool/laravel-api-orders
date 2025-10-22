<?php

namespace App\Services;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockService
{
    public function getStocks(Request $request){
        $dateFrom = $request->query('dateFrom');
        $page = $request->query('page');
        $limit = $request->query('limit');

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
