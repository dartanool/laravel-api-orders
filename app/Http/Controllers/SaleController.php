<?php

namespace App\Http\Controllers;

use App\Services\SaleService;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function __construct(
        private SaleService $saleService
    ){}
    public function index(Request $request){
        $key = $request->query('key');

        if ($key !== env('API_KEY')) {
            return response()->json(['error' => 'Unauthorized'], 201);
        }

        $sales = $this->saleService->getSales($request);

        return response()->json($sales);
    }
}
