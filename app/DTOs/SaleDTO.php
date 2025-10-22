<?php

namespace App\DTOs;


use Illuminate\Http\Request;

class SaleDTO
{
    public ?string $dateFrom;
    public ?string $dateTo;
    public int $page;
    public int $limit;
    public string $key;

    public function __construct(Request $request)
    {
        $this->dateFrom = $request->query('dateFrom');
        $this->dateTo = $request->query('dateTo');
        $this->page = $request->query('page', 1);
        $this->limit = $request->query('limit', 500);
        $this->key = $request->query('key');
    }
}
