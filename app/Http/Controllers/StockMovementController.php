<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockMovement;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

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
            'type'       => 'required|string',
            'quantity'   => 'required|integer|min:1',
            'reason'     => 'nullable|string',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $type = strtolower(trim($validated['type']));

        DB::transaction(function () use ($validated, $product, $type) {
            // 1. Simpan Log Movement
            StockMovement::create([
                'product_id'   => $validated['product_id'],
                'type'         => $validated['type'],
                'quantity'     => $validated['quantity'],
                'reason'       => $validated['reason'] ?? null,
                'created_by'   => auth()->user()->name ?? 'System',
            ]);

            // 2. Perbaikan Logika Matematika Stok
            if (in_array($type, ['in', 'stock in', 'return'])) {
                // Stock In & Return = Menambah Stok (+)
                $product->increment('stock', $validated['quantity']);
            } elseif (in_array($type, ['out', 'stock out', 'damage'])) {
                // Stock Out & Damage = Mengurangi Stok (-)
                $product->decrement('stock', $validated['quantity']);
            } elseif ($type === 'adjustment') {
                // Adjustment = Menyesuaikan langsung ke angka fisik baru
                $product->update(['stock' => $validated['quantity']]);
            }
        });

        return response()->json([
            'status'  => 'success',
            'message' => 'Stock movement recorded successfully'
        ]);
    }

    public function show($id)
    {
        $movement = StockMovement::with('product')->findOrFail($id);
        return view('stock-movements.show', compact('movement'));
    }
}