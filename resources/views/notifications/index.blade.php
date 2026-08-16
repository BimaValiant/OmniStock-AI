<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>OmniStock AI - Notifications</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        headline: ['Plus Jakarta Sans', 'sans-serif'],
                    },
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
<body class="bg-slateBg text-slate-300 antialiased font-sans min-h-screen flex selection:bg-slate-700 selection:text-white">
    <aside class="w-64 bg-[#0d1322] border-r border-gray-800/80 min-h-screen p-5 flex flex-col justify-between select-none">
        <div>
            <div class="flex items-center gap-3 px-2 mb-8">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center font-black text-white text-lg shadow-lg shadow-blue-500/20 tracking-wider">OS</div>
                <div>
                    <h1 class="font-bold text-white text-base tracking-wide leading-tight">OmniStock AI</h1>
                    <p class="text-[11px] font-medium text-gray-500">Enterprise Command</p>
                </div>
            </div>

            <nav class="space-y-1.5">
                <a href="{{ url('/') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">Dashboard</a>
                <a href="{{ url('/inventory') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">Inventory</a>
                <a href="{{ url('/transactions') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">Transactions</a>
                <a href="{{ url('/reports') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">Reports</a>
                <a href="{{ url('/notifications') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 bg-slate-700/60 text-white font-semibold shadow-sm">Notifications</a>
            </nav>
        </div>
    </aside>

    <main class="flex-1 p-6 md:p-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="font-headline font-bold text-2xl text-white tracking-tight">Notifications</h1>
                <p class="text-xs text-slate-400 mt-0.5">Low stock alerts and restock urgency overview.</p>
            </div>
            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-amber-950/40 text-amber-300 border border-amber-800/40">Live alert feed</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-slateCard border border-slateBorder rounded-xl p-5">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-headline font-bold text-white text-lg">Low Stock Alerts</h2>
                    <span class="text-xs text-slate-400">{{ $lowStockProducts->count() }} items</span>
                </div>

                <div class="space-y-3">
                    @forelse ($lowStockProducts as $product)
                        <div class="rounded-xl border border-amber-800/40 bg-[#1c1820] p-3">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <p class="font-semibold text-white">{{ $product->name }}</p>
                                    <p class="text-[11px] text-slate-400">SKU: {{ $product->sku }} • {{ $product->category->name ?? 'General' }}</p>
                                </div>
                                <span class="px-2 py-1 rounded-full bg-amber-500/15 text-amber-300 border border-amber-500/30 text-[10px] font-medium">Low Stock</span>
                            </div>
                            <div class="mt-3 flex items-center justify-between text-[11px] text-slate-300">
                                <span>Current stock</span>
                                <strong class="text-white">{{ $product->stock }}</strong>
                            </div>
                            <div class="mt-1 flex items-center justify-between text-[11px] text-slate-300">
                                <span>Minimum alert</span>
                                <strong class="text-white">{{ $product->min_stock_alert }}</strong>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-xl border border-slateBorder bg-[#101827] p-4 text-sm text-slate-300">No low stock products right now.</div>
                    @endforelse
                </div>
            </div>

            <div class="bg-slateCard border border-slateBorder rounded-xl p-5">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-headline font-bold text-white text-lg">Out of Stock</h2>
                    <span class="text-xs text-slate-400">{{ $criticalProducts->count() }} items</span>
                </div>

                <div class="space-y-3">
                    @forelse ($criticalProducts as $product)
                        <div class="rounded-xl border border-red-800/50 bg-[#1d1418] p-3">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <p class="font-semibold text-white">{{ $product->name }}</p>
                                    <p class="text-[11px] text-slate-400">SKU: {{ $product->sku }}</p>
                                </div>
                                <span class="px-2 py-1 rounded-full bg-red-500/15 text-red-300 border border-red-500/30 text-[10px] font-medium">Critical</span>
                            </div>
                            <div class="mt-3 text-[11px] text-slate-300">
                                This item needs immediate restock before it affects sales.
                            </div>
                        </div>
                    @empty
                        <div class="rounded-xl border border-slateBorder bg-[#101827] p-4 text-sm text-slate-300">No critical stock issues at the moment.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
</body>
</html>
