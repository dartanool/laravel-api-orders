<?php

namespace App\Services;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeService
{
    public function getIncomes(Request $request){

        $dateFrom = $request->query('dateFrom');
        $dateTo = $request->query('dateTo');
        $page = $request->query('page');
        $limit = $request->query('limit');

        $query = Income::query();

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
        $incomes = $query->orderBy('created_at', 'desc')
            ->paginate($limit, ['*'], 'page', $page);

        return $incomes;
    }

}
