<?php

namespace App\Services;

use App\DTOs\IncomeDTO;
use App\Models\Income;
use Illuminate\Http\Request;

class IncomeService
{
    public function getIncomes(IncomeDTO $dto){

        $dateFrom = $dto->dateFrom;
        $dateTo = $dto->dateTo;
        $page = $dto->page;
        $limit = $dto->limit;

        $query = Income::query();

        if ($dto->dateFrom) {
            $query->where('created_at', '>=', $dto->dateFrom);
        }

        if ($dto->dateTo) {
            $query->where('created_at', '<=', $dto->dateTo);
        }

        // Пагинация
        $incomes = $query->orderBy('created_at', 'desc')
            ->paginate($dto->limit, ['*'], 'page', $dto->page);

        return $incomes;
    }

}
