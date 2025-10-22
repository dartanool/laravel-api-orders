<?php

namespace App\Services;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleService
{

    public function getSales(Request $request){

        $dateFrom = $request->query('dateFrom');
        $dateTo = $request->query('dateTo');
        $page = $request->query('page', 1);
        $limit = $request->query('limit', 500);

        $query = Sale::query();

        if ($dateFrom) {
            if (strlen($dateFrom) === 10) { // если только дата
                $dateFrom .= ' 00:00:00';
            }
            $query->where('created_at', '>=', $dateFrom);
        }

        if ($dateTo) {
            if (strlen($dateTo) === 10) { // если только дата
                $dateTo .= ' 23:59:59';
            }
            $query->where('created_at', '<=', $dateTo);
        }

        // Пагинация
        $sales = $query->orderBy('created_at', 'desc')
            ->paginate($limit, ['*'], 'page', $page);

        return $sales;
    }
}
