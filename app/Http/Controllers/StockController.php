<?php

namespace App\Http\Controllers;

use App\DTOs\StockDTO;
use App\Services\StockService;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function __construct(
        private StockService $stockService
    ){}
    public function index(Request $request){
        $dto = new StockDTO($request);

        if($dto->key !== env('API_KEY')){
            return response()->json(['error' => 'Unauthorized']);
        }

        $stocks = $this->stockService->getStocks($dto);

        return response()->json($stocks);
    }
}
