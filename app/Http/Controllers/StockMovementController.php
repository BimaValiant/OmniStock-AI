<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockMovement;
use App\Models\Product;

class StockMovementController extends Controller
{
    public function index()
    {
        $movements = StockMovement::with('product')
            ->latest()
            ->paginate(50);
        
        return view('stock-movements.index', compact('movements'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:in,out,adjustment,return,damage',
            'quantity' => 'required|integer|min:1',
            'reason' => 'nullable|string',
        ]);

        $product = Product::find($validated['product_id']);
        
        $validated['created_by'] = auth()->user()->name ?? 'System';
        
        $movement = StockMovement::create($validated);

        // Update product stock based on type
        if (in_array($validated['type'], ['in', 'adjustment'])) {
            $product->increment('stock', $validated['quantity']);
        } else {
            $product->decrement('stock', $validated['quantity']);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Stock movement recorded successfully',
            'movement' => $movement
        ]);
    }

    public function show($id)
    {
        $movement = StockMovement::with('product')->findOrFail($id);
        return view('stock-movements.show', compact('movement'));
    }
}
