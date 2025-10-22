<?php

namespace App\Http\Controllers;

use App\DTOs\SaleDTO;
use App\Services\SaleService;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function __construct(
        private SaleService $saleService
    ){}
    public function index(Request $request){
        $dto = new SaleDTO($request);

//        if ($dto->key !== env('API_KEY')) {
//            return response()->json(['error' => 'Unauthorized'], 201);
//        }

        $sales = $this->saleService->getSales($dto);

        return response()->json($sales);
    }
}
