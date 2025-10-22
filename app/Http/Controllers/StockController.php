<?php

namespace App\Http\Controllers;

use App\Services\StockService;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function __construct(
        private StockService $stockService
    ){}
    public function index(Request $request){
        $key = $request->query('key');
        if($key !== env('API_KEY')){
            return response()->json(['error' => 'Unauthorized']);
        }

        $stocks = $this->stockService->getStocks($request);

        return response()->json($stocks);
    }
}
