<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>OmniStock AI - Inventory Management</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

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
<body class="bg-slateBg text-slate-300 antialiased font-sans selection:bg-slate-700 selection:text-white m-0 p-0">
    <div class="flex h-screen w-screen">
        <!-- SIDEBAR -->
        <aside class="w-64 bg-[#0d1322] border-r border-gray-800/80 flex flex-col p-5 overflow-y-auto select-none">
            <div class="flex-shrink-0">
                <div class="flex items-center gap-3 px-2 mb-8">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center font-black text-white text-lg shadow-lg shadow-blue-500/20 tracking-wider flex-shrink-0">
                        OS
                    </div>
                    <div>
                        <h1 class="font-bold text-white text-base tracking-wide leading-tight">OmniStock AI</h1>
                        <p class="text-[11px] font-medium text-gray-500">ENTERPRISE SUITE</p>
                    </div>
                </div>

                <div class="mb-5">
                    <button class="w-full flex items-center justify-center gap-2 bg-[#f3f4f6] text-[#111827] font-semibold text-sm rounded-xl py-2.5 shadow-sm hover:bg-gray-100 transition">
                        <span class="text-lg leading-none">+</span> New Transaction
                    </button>
                </div>

                <nav class="space-y-1.5">
                    <a href="{{ url('/') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        <span class="truncate">Dashboard</span>
                    </a>
                    <a href="{{ url('/inventory') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('inventory') ? 'bg-slate-700/60 text-white font-semibold shadow-sm' : 'text-gray-400 hover:bg-gray-800/50 hover:text-gray-200' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <span class="truncate">Inventory</span>
                    </a>
                    <a href="{{ url('/transactions') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z"></path>
                        </svg>
                        <span class="truncate">Transactions</span>
                    </a>
                    <a href="{{ url('/stock-movements') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <span class="truncate">Stock Movements</span>
                    </a>
                    <a href="{{ url('/purchase-orders') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span class="truncate">Purchase Orders</span>
                    </a>
                    <a href="{{ url('/suppliers') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="truncate">Suppliers</span>
                    </a>
                    <a href="{{ url('/reports') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span class="truncate">Reports</span>
                    </a>
                    <a href="{{ url('/settings') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="truncate">Settings</span>
                    </a>
                </nav>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col bg-slateBg overflow-hidden">
            <!-- HEADER -->
            <header class="h-14 border-b border-slateBorder bg-[#0b1220] px-6 flex items-center justify-between flex-shrink-0">
                <div class="relative flex-1 max-w-[360px]">
                    <input type="text" placeholder="Search inventory, SKU, name, or category" class="w-full bg-[#111622] border border-slateBorder/80 rounded-lg py-2 pl-9 pr-3 text-xs text-slate-200 focus:outline-none focus:border-slate-500 placeholder-slate-500">
                    <span class="absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-500 text-xs">🔍</span>
                </div>
                <div class="flex items-center gap-2.5 ml-4 flex-shrink-0">
                    <button class="bg-[#212938] border border-slate-600/50 hover:bg-slate-700 text-white text-xs font-medium px-3.5 py-1.5 rounded-lg flex items-center gap-1.5 transition whitespace-nowrap">
                        <span>+</span> Add Product
                    </button>
                    <button class="px-3.5 py-1.5 bg-[#131722] hover:bg-gray-800 border border-gray-800 rounded-xl text-xs font-semibold text-gray-200 transition-all whitespace-nowrap">
                        Record Sale
                    </button>
                    <button class="p-1.5 bg-[#18202F] border border-slateBorder rounded-lg text-slate-400 hover:text-slate-200 flex-shrink-0">🔔</button>
                </div>
            </header>

            <!-- PAGE CONTENT -->
            <main class="flex-1 overflow-y-auto p-6 md:p-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="font-headline font-bold text-2xl text-white tracking-tight">Inventory Management</h1>
                        <p class="text-xs text-slate-400 mt-0.5">Manage and track your products across all warehouses.</p>
                    </div>
                    <div class="flex items-center gap-2 flex-shrink-0">
                        <button class="bg-[#0B0F19] border border-slateBorder text-xs text-slate-300 px-2.5 py-1.5 rounded-lg hover:bg-slate-800 transition">Export CSV</button>
                        <button class="bg-slate-200 hover:bg-white text-slate-900 font-semibold text-xs px-3.5 py-1.5 rounded-lg transition">Add Product</button>
                    </div>
                </div>

                <div class="mb-5 flex items-center gap-2 flex-wrap">
                    <button class="px-3 py-1.5 text-xs bg-[#111622] border border-slateBorder rounded-lg text-slate-200 hover:bg-[#1a1f2e] transition">All Categories</button>
                    <button class="px-3 py-1.5 text-xs bg-[#111622] border border-slateBorder rounded-lg text-slate-200 hover:bg-[#1a1f2e] transition">Status: Any</button>
                    <button class="px-3 py-1.5 text-xs bg-[#111622] border border-slateBorder rounded-lg text-slate-200 hover:bg-[#1a1f2e] transition">Supplier: All</button>
                    <button class="px-3 py-1.5 text-xs bg-[#111622] border border-slateBorder rounded-lg text-slate-200 hover:bg-[#1a1f2e] transition">More Filters</button>
                </div>

                <div class="bg-slateCard border border-slateBorder rounded-xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs text-slate-300">
                            <thead class="text-[10px] text-slate-400 uppercase bg-[#0B0F19]/60 border-b border-slateBorder">
                                <tr>
                                    <th class="py-2.5 px-3">PRODUCT</th>
                                    <th class="py-2.5 px-3">SKU</th>
                                    <th class="py-2.5 px-3">CATEGORY</th>
                                    <th class="py-2.5 px-3">STOCK LEVEL</th>
                                    <th class="py-2.5 px-3">UNIT PRICE</th>
                                    <th class="py-2.5 px-3">STATUS</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slateBorder/40">
                                @forelse($products ?? [] as $p)
                                    <tr class="hover:bg-slate-800/20">
                                        <td class="py-3 px-3 text-white">
                                            <div class="flex items-center gap-3">
                                                <div class="w-9 h-9 rounded-lg bg-[#1b2430] border border-[#2a2f3a] flex items-center justify-center text-[10px] font-bold text-gray-200 flex-shrink-0">
                                                    {{ strtoupper(substr($p->name, 0, 2)) }}
                                                </div>
                                                <div class="min-w-0">
                                                    <div class="font-medium truncate">{{ $p->name }}</div>
                                                    <div class="text-[10px] text-slate-400">{{ $p->category->name ?? 'General' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 font-mono text-[11px] text-slate-300">{{ $p->sku }}</td>
                                        <td class="py-3 px-3"><span class="px-2 py-1 rounded bg-[#0f172a] border border-slateBorder text-[10px] text-slate-300">{{ $p->category->name ?? 'General' }}</span></td>
                                        <td class="py-3 px-3">
                                            <div class="flex items-center gap-3 min-w-[150px]">
                                                <span class="text-white font-medium">{{ $p->stock }}</span>
                                                <div class="w-24 h-2 bg-[#1b2430] rounded-full overflow-hidden flex-shrink-0">
                                                    <div class="h-full rounded-full bg-white" style="width: {{ min(100, ($p->stock / max(1, $p->min_stock_alert + 10)) * 100) }}%"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 text-slate-200">Rp {{ number_format($p->selling_price, 0, ',', '.') }}</td>
                                        <td class="py-3 px-3">
                                            @if($p->stock == 0)
                                                <span class="px-2 py-1 rounded-full bg-[#2d1b1e] text-[#fca5a5] border border-[#7f1d1d] text-[10px] font-medium">Out of Stock</span>
                                            @elseif($p->stock <= $p->min_stock_alert)
                                                <span class="px-2 py-1 rounded-full bg-[#2b261a] text-[#fbbf24] border border-[#b45309] text-[10px] font-medium">Low Stock</span>
                                            @else
                                                <span class="px-2 py-1 rounded-full bg-[#142f2c] text-[#86efac] border border-[#166534] text-[10px] font-medium">In Stock</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-12 text-center text-slate-400">No products available yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
