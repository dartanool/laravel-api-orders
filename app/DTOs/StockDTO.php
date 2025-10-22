<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class StockDTO
{
    public string $key;
    public ?string $dateFrom;
    public int $page;
    public int $limit;

    public function __construct( Request $request ){
        $this->key = $request->get('key');
        $this->dateFrom = $request->get('dateFrom');
        $this->page = $request->get('page', 1);
        $this->limit = $request->get('limit', 500);
    }
}
