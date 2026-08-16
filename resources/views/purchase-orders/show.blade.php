<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OmniStock AI - PO Details {{ $po->po_code }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        slateBg: '#0D111D',
                        slateCard: '#131927',
                        slateBorder: '#1E293B',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slateBg text-slate-300 font-sans antialiased p-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <a href="{{ url('/purchase-orders') }}" class="text-xs text-indigo-400 hover:text-indigo-300 font-semibold mb-2 inline-block">← Back to Purchase Orders</a>
                <h1 class="text-2xl font-bold text-white tracking-tight">Purchase Order Details</h1>
                <p class="text-xs text-slate-400">PO Code: <span class="font-mono text-slate-200">{{ $po->po_code }}</span></p>
            </div>
            <div>
                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase 
                    @if(strtolower($po->status) == 'received') bg-emerald-950/80 text-emerald-400 border border-emerald-800/50
                    @elseif(strtolower($po->status) == 'pending') bg-amber-950/80 text-amber-400 border border-amber-800/50
                    @else bg-slate-800 text-slate-400 border border-slate-700 @endif">
                    {{ $po->status }}
                </span>
            </div>
        </div>

        <!-- Info Cards Grid -->
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div class="bg-slateCard border border-slateBorder p-4 rounded-xl">
                <h3 class="text-xs font-semibold text-slate-400 uppercase mb-2">Supplier Info</h3>
                <p class="text-sm font-bold text-white">{{ $po->supplier->name ?? 'N/A' }}</p>
                <p class="text-xs text-slate-400">{{ $po->supplier->email ?? '-' }} | {{ $po->supplier->phone ?? '-' }}</p>
            </div>
            <div class="bg-slateCard border border-slateBorder p-4 rounded-xl">
                <h3 class="text-xs font-semibold text-slate-400 uppercase mb-2">Order Info</h3>
                <p class="text-xs text-slate-300">Order Date: <span class="font-semibold text-white">{{ $po->created_at ? $po->created_at->format('d M Y') : '-' }}</span></p>
                <p class="text-xs text-slate-300">Expected Delivery: <span class="font-semibold text-white">{{ $po->expected_delivery ?? '-' }}</span></p>
            </div>
        </div>

        <!-- Order Items Table -->
        <div class="bg-slateCard border border-slateBorder rounded-xl overflow-hidden shadow-xl mb-6">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slateBorder bg-[#0f1420] text-[10px] uppercase font-bold text-slate-400 tracking-wider">
                        <th class="p-4">Product Item</th>
                        <th class="p-4 text-center">Qty</th>
                        <th class="p-4 text-right">Unit Price</th>
                        <th class="p-4 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slateBorder/60 text-xs">
                    @forelse($po->items as $item)
                        <tr class="hover:bg-slate-800/30">
                            <td class="p-4 font-medium text-white">{{ $item->product->name ?? 'Product Removed' }}</td>
                            <td class="p-4 text-center text-slate-200">{{ $item->quantity }}</td>
                            <td class="p-4 text-right text-slate-300">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                            <td class="p-4 text-right font-semibold text-white">Rp {{ number_format($item->quantity * $item->unit_price, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-slate-500">No items recorded in this PO.</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="border-t border-slateBorder bg-[#0f1420]">
                        <td colspan="3" class="p-4 font-bold text-slate-300 text-right uppercase text-xs">Total Amount</td>
                        <td class="p-4 font-bold text-emerald-400 text-right text-sm">Rp {{ number_format($po->total_amount ?? $po->items->sum(fn($i) => $i->quantity * $i->unit_price), 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        @if($po->notes)
            <div class="bg-slateCard border border-slateBorder p-4 rounded-xl text-xs">
                <h4 class="font-semibold text-slate-400 mb-1">Notes:</h4>
                <p class="text-slate-300">{{ $po->notes }}</p>
            </div>
        @endif
    </div>
</body>
</html>