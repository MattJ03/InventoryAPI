<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
class StockController extends Controller
{
    public function index(StockService $stockService, Request $request) {
    if($request->user()) {
        $stocks = $stockService->index();
    }
    }

public function create(StockService $stockService, Request $request) {

}
}
