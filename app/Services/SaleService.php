<?php

namespace App\Services;

use App\DTOs\SaleDTO;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleService
{

    public function getSales(SaleDTO $dto){

        $dateFrom = $dto->dateFrom;
        $dateTo = $dto->dateTo;
        $page = $dto->page;
        $limit = $dto->limit;

        $query = Sale::query();

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
        $sales = $query->orderBy('created_at', 'desc')
            ->paginate($limit, ['*'], 'page', $page);

        return $sales;
    }
}
