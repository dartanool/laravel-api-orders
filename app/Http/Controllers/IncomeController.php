<?php

namespace App\Http\Controllers;

use App\DTOs\IncomeDTO;
use App\Services\IncomeService;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function __construct(
        private IncomeService $incomeService
    ){}
    public function index(Request $request){
        $dto = new IncomeDTO($request);

        if ($dto->key !== env('API_KEY')) {
            return response()->json(['error' => 'Unauthorized']);
        }

        $incomes = $this->incomeService->getIncomes($dto);


        return response()->json($incomes);
    }

}
