@props(['products' => []])

<div class="p-6 bg-[#131927] border border-[#1E2638] rounded-2xl space-y-4">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-2">
            <i data-lucide="package-check" class="w-5 h-5 text-slate-400"></i>
            <h4 class="font-bold text-white text-sm">Stock Status</h4>
        </div>
        <div class="flex items-center gap-2">
            <button class="px-3 py-1.5 bg-slate-800/80 hover:bg-slate-700/80 text-slate-300 text-xs rounded-xl border border-slate-700/60 flex items-center gap-1.5 transition">
                <i data-lucide="filter" class="w-3.5 h-3.5"></i> Filter
            </button>
            <button class="px-3 py-1.5 bg-slate-800/80 hover:bg-slate-700/80 text-slate-300 text-xs rounded-xl border border-slate-700/60 flex items-center gap-1.5 transition">
                <i data-lucide="download" class="w-3.5 h-3.5"></i> Export
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-slate-400">
            <thead class="text-[11px] uppercase tracking-wider text-slate-500 border-b border-[#1E2638]">
                <tr>
                    <th class="pb-3 px-2">Product</th>
                    <th class="pb-3 px-2">SKU</th>
                    <th class="pb-3 px-2">Category</th>
                    <th class="pb-3 px-2">Stock Level</th>
                    <th class="pb-3 px-2">Status</th>
                    <th class="pb-3 px-2 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#1E2638]">
                @forelse($products as $product)
                    <tr class="hover:bg-slate-800/30 transition">
                        <td class="py-3 px-2 font-medium text-slate-200 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-slate-800/80 border border-slate-700/60 flex items-center justify-center text-slate-400">
                                <i data-lucide="{{ $product->image_icon ?? 'package' }}" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-white">{{ $product->name }}</p>
                                <p class="text-[10px] text-slate-500">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</p>
                            </div>
                        </td>
                        <td class="py-3 px-2 font-mono text-slate-400">{{ $product->sku }}</td>
                        <td class="py-3 px-2">{{ $product->category->name ?? 'Uncategorized' }}</td>
                        <td class="py-3 px-2 w-32">
                            <div class="flex items-center gap-2">
                                <div class="w-full bg-slate-800 h-1.5 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full {{ $product->stock == 0 ? 'bg-rose-500 w-[0%]' : ($product->stock <= $product->min_stock_alert ? 'bg-amber-500 w-[20%]' : 'bg-emerald-500 w-[85%]') }}"></div>
                                </div>
                                <span class="text-[10px] font-bold {{ $product->stock <= $product->min_stock_alert ? 'text-amber-400' : 'text-slate-300' }}">
                                    {{ $product->stock }}
                                </span>
                            </div>
                        </td>
                        <td class="py-3 px-2">
                            @if($product->stock == 0)
                                <span class="px-2 py-0.5 text-[10px] font-semibold text-rose-400 bg-rose-500/10 rounded-full border border-rose-500/20">
                                    Out of Stock
                                </span>
                            @elseif($product->stock <= $product->min_stock_alert)
                                <span class="px-2 py-0.5 text-[10px] font-semibold text-amber-400 bg-amber-500/10 rounded-full border border-amber-500/20">
                                    Low
                                </span>
                            @else
                                <span class="px-2 py-0.5 text-[10px] font-semibold text-emerald-400 bg-emerald-500/10 rounded-full border border-emerald-500/20">
                                    In Stock
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-2 text-right">
                            <button class="p-1.5 text-slate-400 hover:text-white"><i data-lucide="more-horizontal" class="w-4 h-4"></i></button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-slate-500">Belum ada data produk di database.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>