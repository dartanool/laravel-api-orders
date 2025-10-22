<?php

namespace App\Services;

use App\DTOs\SaleDTO;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleService
{

    public function getSales(SaleDTO $dto){

        $query = Sale::query();

        if ($dto->dateFrom) {
            $query->where('created_at', '>=', $dto->dateFrom);
        }

        if ($dto->dateTo) {
            $query->where('created_at', '<=', $dto->dateTo);
        }

        // Пагинация
        $sales = $query->orderBy('created_at', 'desc')
            ->paginate($dto->limit, ['*'], 'page', $dto->page);

        return $sales;
    }
}
