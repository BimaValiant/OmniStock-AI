<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Support\Str;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $purchaseOrders = PurchaseOrder::with('supplier', 'items.product')
            ->latest()
            ->paginate(20);
        
        $suppliers = Supplier::all();
        $products = Product::all();
        
        return view('purchase-orders.index', compact('purchaseOrders', 'suppliers', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'order_date' => 'required|date',
            'expected_delivery' => 'nullable|date|after:order_date',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $totalAmount = 0;
        foreach ($validated['items'] as $item) {
            $totalAmount += $item['quantity'] * $item['unit_price'];
        }

        $poCode = 'PO-' . strtoupper(Str::random(8)) . '-' . date('Ymd');

        $po = PurchaseOrder::create([
            'po_code' => $poCode,
            'supplier_id' => $validated['supplier_id'],
            'status' => 'draft',
            'total_amount' => $totalAmount,
            'order_date' => $validated['order_date'],
            'expected_delivery' => $validated['expected_delivery'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'created_by' => auth()->user()->name ?? 'System'
        ]);

        foreach ($validated['items'] as $item) {
            PurchaseOrderItem::create([
                'purchase_order_id' => $po->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Purchase Order created successfully',
            'po_code' => $poCode
        ]);
    }

    public function show($id)
    {
        $po = PurchaseOrder::with('supplier', 'items.product')->findOrFail($id);
        return view('purchase-orders.show', compact('po'));
    }

    public function updateStatus(Request $request, $id)
    {
        $po = PurchaseOrder::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|in:draft,pending,ordered,partially_received,received,cancelled'
        ]);

        $po->update(['status' => $validated['status']]);

        if ($validated['status'] === 'received') {
            // Auto-receive all items
            $po->received_date = now();
            $po->save();

            foreach ($po->items as $item) {
                $item->received_qty = $item->quantity;
                $item->save();

                // Add stock movement
                $product = $item->product;
                $product->increment('stock', $item->quantity);

                \App\Models\StockMovement::create([
                    'product_id' => $product->id,
                    'type' => 'in',
                    'quantity' => $item->quantity,
                    'reference_id' => 'PO-' . $po->id,
                    'reason' => 'Purchase Order Received: ' . $po->po_code,
                    'created_by' => auth()->user()->name ?? 'System'
                ]);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Purchase Order status updated'
        ]);
    }

    public function destroy($id)
    {
        $po = PurchaseOrder::findOrFail($id);
        $po->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Purchase Order deleted'
        ]);
    }
}
