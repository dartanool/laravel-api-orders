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
        $incomes = $query->orderBy('created_at', 'desc')
            ->paginate($limit, ['*'], 'page', $page);

        return $incomes;
    }

}
