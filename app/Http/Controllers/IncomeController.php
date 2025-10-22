<?php

namespace App\Http\Controllers;

use App\Services\IncomeService;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function __construct(
        private IncomeService $incomeService
    ){}
    public function index(Request $request){
        $key = $request->query('key');

        if ($key !== env('API_KEY')) {
            return response()->json(['error' => 'Unauthorized']);
        }

        $incomes = $this->incomeService->getIncomes($request);


        return response()->json($incomes);
    }

}
