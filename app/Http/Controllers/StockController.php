<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StockService;
use App\Models\Stock;
use App\Models\User;
class StockController extends Controller
{
    public function index(StockService $stockService,) {
        $stock = $stockService->index();
          
        return response()->json([
            'data' => $stock
          ]);
    }

  public function create(StockService $stockService, Request $request) {
        $this->authorize('create', Stock::class);
        
        $data = $request->validate([
            'name' => 'required|min:3|max:25',
            'capacity' => 'required|integer',
            'price' => 'required|numeric|min:0.01',
            'inStock' => 'required|boolean',

        ]);
    $stockService->create($data);
    return response()->json(['Message', 'stock created', 'stock', $data]);
}

    public function show(StockService $stockService, Request $request) {
        $this->authorize('view', Stock::class);
        $stock = $stockService->show($request->id);
          return response()->json($stock);
    }

    public function update(StockService $stockService, Request $request) {
        $stock = Stock::findOrFail($request->id);
        $this->authorize('update', Stock::class);
        $data = $request->validate([
            'name' => 'required|min:3|max:25',
            'capacity' => 'required|integer',
            'price' => 'required|numeric|min:0.01',
            'inStock' => 'required|boolean',

        ]);
        $stockService->update($data, $stock);
        return response()->json(['Message', 'Stock updated']);
    }

    public function delete(StockService $stockService, Request $request) {
        $this->authorize('delete', Stock::class);
        $stock = Stock::findOrFail($request->id);
        $stockService->delete($stock);
        return response()->json(['Message', 'Stock deleted']);
    }

}
