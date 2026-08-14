<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>OmniStock AI - Enterprise Command</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

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
                        slateActive: '#78889B',
                    }
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-slateBg text-slate-300 antialiased font-sans min-h-screen flex selection:bg-slate-700 selection:text-white">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#0d1322] border-r border-gray-800/80 min-h-screen p-5 flex flex-col justify-between select-none">
    <div>
        <!-- Brand Logo & Name -->
        <div class="flex items-center gap-3 px-2 mb-8">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center font-black text-white text-lg shadow-lg shadow-blue-500/20 tracking-wider">
                OS
            </div>
            <div>
                <h1 class="font-bold text-white text-base tracking-wide leading-tight">OmniStock AI</h1>
                <p class="text-[11px] font-medium text-gray-500">Enterprise Command</p>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="space-y-1.5">
            <!-- Dashboard -->
            <a href="{{ url('/') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('/') ? 'bg-slate-700/60 text-white font-semibold shadow-sm' : 'text-gray-400 hover:bg-gray-800/50 hover:text-gray-200' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                Dashboard
            </a>

            <!-- Inventory -->
            <a href="{{ url('/') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                Inventory
            </a>

            <!-- Transactions (Sudah Pake Ikon + Active Style) -->
            <a href="{{ url('/transactions') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('transactions') ? 'bg-slate-700/60 text-white font-semibold shadow-sm' : 'text-gray-400 hover:bg-gray-800/50 hover:text-gray-200' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z"></path>
                </svg>
                Transactions
            </a>

            <!-- Suppliers -->
            <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                Suppliers
            </a>

            <!-- Reports -->
            <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Reports
            </a>

            <!-- Settings -->
            <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Settings
            </a>
        </nav>
    </div>
</aside>

    <!-- MAIN CONTENT AREA -->
    <main class="flex-1 p-6 md:p-8 overflow-y-auto">
        
        <!-- TOP HEADER / NAVBAR -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div class="relative w-full sm:w-80">
                <input type="text" id="globalSearchInput" placeholder="Search inventory, sales, insights..." class="w-full bg-[#111622] border border-slateBorder/80 rounded-lg py-1.5 pl-8 pr-12 text-xs text-slate-200 focus:outline-none focus:border-slate-500 placeholder-slate-500">
                <span class="absolute left-2.5 top-2 text-slate-500 text-xs">🔍</span>
                <span class="absolute right-2.5 top-1.5 text-[10px] text-slate-500 border border-slateBorder px-1 py-0.2 rounded bg-slateBg">Ctrl+K</span>
            </div>

            <div class="flex items-center gap-2.5">
                <button onclick="openModal('addProductModal')" class="bg-[#212938] border border-slate-600/50 hover:bg-slate-700 text-white text-xs font-medium px-3.5 py-1.5 rounded-lg flex items-center gap-1.5 transition">
                    <span>+</span> Add Product
                </button>
                <button onclick="document.getElementById('modalRecordSale').classList.remove('hidden')" class="px-4 py-2 bg-[#131722] hover:bg-gray-800 border border-gray-800 rounded-xl text-xs font-semibold text-gray-200 transition-all">
    📄 Record Sale
</button>
                <button class="p-1.5 bg-[#18202F] border border-slateBorder rounded-lg text-slate-400 hover:text-slate-200">🔔</button>
                <button class="p-1.5 bg-[#18202F] border border-slateBorder rounded-lg text-slate-400 hover:text-slate-200">🕒</button>
            </div>
        </div>

        <!-- COMMAND CENTER TITLE & STATUS -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="font-headline font-bold text-2xl text-white tracking-tight">Command Center</h1>
                <p class="text-xs text-slate-400 mt-0.5">Real-time overview of your enterprise assets.</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-950/40 text-emerald-400 border border-emerald-800/40">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> System Online
                </span>
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-slate-800/40 text-slate-400 border border-slate-700/60">
                    🔄 Just updated
                </span>
            </div>
        </div>

        <!-- 4 STAT CARDS ROW (DYNAMIC DATA) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-slateCard border border-slateBorder rounded-xl p-4 relative">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total Asset Value</p>
                <h2 class="font-headline text-2xl font-extrabold text-white mb-2">Rp {{ number_format($totalAssetValue ?? 1200000000, 0, ',', '.') }}</h2>
                <div class="flex items-center gap-1.5 text-[11px]">
                    <span class="bg-emerald-950/60 text-emerald-400 px-1.5 py-0.2 rounded font-semibold border border-emerald-800/40">+4.2%</span>
                    <span class="text-slate-500">vs last month</span>
                </div>
            </div>

            <div class="bg-slateCard border border-slateBorder rounded-xl p-4 relative">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Monthly Sales</p>
                <h2 class="font-headline text-2xl font-extrabold text-white mb-2">+12%</h2>
                <div class="flex items-center gap-1.5 text-[11px]">
                    <span class="bg-emerald-950/60 text-emerald-400 px-1.5 py-0.2 rounded font-semibold border border-emerald-800/40">Target Met</span>
                    <span class="text-slate-500">Steady growth</span>
                </div>
            </div>

            <div class="bg-[#1C1420] border border-red-900/30 rounded-xl p-4 relative">
                <p class="text-[10px] font-bold text-red-400 uppercase tracking-wider mb-1">⚠️ Low Stock Alerts</p>
                <div class="flex items-baseline gap-1.5 mb-2">
                    <span class="font-headline text-2xl font-extrabold text-white">{{ $lowStockCount ?? 5 }}</span>
                    <span class="text-xs text-slate-400">items</span>
                </div>
                <div class="flex items-center gap-1.5 text-[11px]">
                    <span class="bg-amber-950/80 text-amber-400 px-1.5 py-0.2 rounded font-semibold border border-amber-800/40">Amber Status</span>
                    <span class="text-slate-400">Action required</span>
                </div>
            </div>

            <div class="bg-slateCard border border-slateBorder rounded-xl p-4 relative">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Retain Margin</p>
                <h2 class="font-headline text-2xl font-extrabold text-white mb-2">24%</h2>
                <div class="flex items-center gap-1.5 text-[11px]">
                    <span class="bg-slate-800 text-slate-300 px-1.5 py-0.2 rounded font-semibold">Stable</span>
                    <span class="text-slate-500">Consistent average</span>
                </div>
            </div>
        </div>

        <!-- MIDDLE SECTION: CHART + OMNIBOT PANEL -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <div class="lg:col-span-2 bg-slateCard border border-slateBorder rounded-xl p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between mb-2">
                    <div>
                        <h3 class="font-headline font-bold text-white text-sm">Sales vs Inventory Demand</h3>
                        <p class="text-[11px] text-slate-400">30-day trailing projection</p>
                    </div>
                    <button class="text-slate-500 hover:text-slate-300">⋮</button>
                </div>
                <div class="h-56 w-full relative">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <!-- OMNIBOT AI INSIGHTS WIDGET -->
            <div class="bg-slateCard border border-slateBorder rounded-xl p-5 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <span class="p-1 bg-indigo-950/60 text-indigo-400 rounded text-xs">🤖</span>
                            <h3 class="font-headline font-bold text-white text-sm">OmniBot AI Insights</h3>
                        </div>
                        <span class="text-[10px] bg-slate-800/80 text-slate-400 px-2 py-0.5 rounded-full border border-slate-700">Active</span>
                    </div>

                    <div class="bg-[#0F1522] border-l-2 border-amber-500 p-3 rounded-r-lg mb-4 border-y border-r border-slateBorder/50">
                        <p class="text-xs text-slate-300 leading-relaxed">
                            <strong class="text-slate-100">Attention:</strong> {{ $lowStockCount ?? 3 }} items predicted to run out based on current velocity.
                        </p>
                    </div>
                </div>

                <div>
                    <p class="text-[11px] text-slate-400 mb-2 font-medium">Recommended Action</p>
                    <button onclick="triggerQuickPrompt('Tolong buatkan Draft Purchase Order (PO) untuk semua barang yang stoknya kritis atau habis saat ini.')" class="w-full bg-slate-200 hover:bg-white text-slate-900 font-semibold text-xs py-2 rounded-lg flex items-center justify-center gap-1.5 transition">
                        Generate Purchase Order <span>→</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- BOTTOM SECTION: STOCK STATUS TABLE -->
        <div class="bg-slateCard border border-slateBorder rounded-xl p-5">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <span class="text-slate-400">📦</span>
                    <h3 class="font-headline font-bold text-white text-sm">Stock Status</h3>
                </div>
                <div class="flex items-center gap-2">
                    <button class="bg-[#0B0F19] border border-slateBorder text-xs text-slate-300 px-2.5 py-1 rounded-lg hover:bg-slate-800 transition">Filter</button>
                    <a href="{{ route('inventory.export') }}" class="bg-[#0B0F19] border border-slateBorder text-xs text-slate-300 px-2.5 py-1 rounded-lg hover:bg-slate-800 transition inline-flex items-center gap-1">
                        <span>📥</span> Export CSV
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-300">
                    <thead class="text-[10px] text-slate-400 uppercase bg-[#0B0F19]/60 border-b border-slateBorder">
                        <tr>
                            <th class="py-2.5 px-3">PRODUCT</th>
                            <th class="py-2.5 px-3">SKU</th>
                            <th class="py-2.5 px-3">CATEGORY</th>
                            <th class="py-2.5 px-3">STOCK LEVEL</th>
                            <th class="py-2.5 px-3">STATUS</th>
                            <th class="py-2.5 px-3 text-right">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slateBorder/40">
                        @forelse($products ?? [] as $p)
                        <tr class="hover:bg-slate-800/20">
                            <td class="py-3 px-3 font-medium text-white">
                                <div>{{ $p->name }}</div>
                                <div class="text-[10px] text-slate-500">Rp {{ number_format($p->selling_price, 0, ',', '.') }}</div>
                            </td>
                            <td class="py-3 px-3 text-slate-400 font-mono text-[11px]">{{ $p->sku }}</td>
                            <td class="py-3 px-3"><span class="bg-slate-800 px-2 py-0.5 rounded text-[10px]">{{ $p->category->name ?? 'General' }}</span></td>
                            <td class="py-3 px-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-24 bg-slate-800 h-1 rounded-full overflow-hidden">
                                        @php
                                            $percent = min(100, max(0, ($p->stock / max(1, $p->min_stock_alert * 3)) * 100));
                                            $color = $p->stock == 0 ? 'bg-red-500' : ($p->stock <= $p->min_stock_alert ? 'bg-amber-400' : 'bg-emerald-400');
                                        @endphp
                                        <div class="{{ $color }} h-full" style="width: {{ $percent }}%"></div>
                                    </div>
                                    <span class="font-bold text-white text-[11px]">{{ $p->stock }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-3">
                                @if($p->stock == 0)
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-medium bg-red-950/60 text-red-400 border border-red-800/40">Out</span>
                                @elseif($p->stock <= $p->min_stock_alert)
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-medium bg-amber-950/60 text-amber-400 border border-amber-800/40">Low</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-medium bg-emerald-950/60 text-emerald-400 border border-emerald-800/40">In Stock</span>
                                @endif
                            </td>
                            <td class="py-3 px-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button onclick='openEditModal(@json($p))' class="text-indigo-400 hover:text-indigo-300 font-medium text-xs">Edit</button>
                                    <button onclick="deleteProduct({{ $p->id }})" class="text-red-400 hover:text-red-300 font-medium text-xs">Delete</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="hover:bg-slate-800/20">
                            <td class="py-3 px-3 font-medium text-white">Quantum Noise-Canceling Headphones</td>
                            <td class="py-3 px-3 text-slate-400 font-mono text-[11px]">QNC-882-BK</td>
                            <td class="py-3 px-3"><span class="bg-slate-800 px-2 py-0.5 rounded text-[10px]">Electronics</span></td>
                            <td class="py-3 px-3"><span class="font-bold text-white text-[11px]">420</span></td>
                            <td class="py-3 px-3"><span class="px-2 py-0.5 rounded-full text-[10px] font-medium bg-emerald-950/60 text-emerald-400 border border-emerald-800/40">In Stock</span></td>
                            <td class="py-3 px-3 text-right text-slate-500">•••</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- TABLE FOOTER CLICKABLE PROMPTS -->
            <div class="mt-4 flex items-center justify-between text-[11px] text-slate-500">
                <span>Showing 1-{{ count($products ?? [1,2,3]) }} items</span>
                <div class="flex gap-1.5">
                    <button onclick="triggerQuickPrompt('Barang apa saja yang pergerakannya paling lambat dan menumpuk di gudang?')" class="px-2 py-1 bg-[#0B0F19] border border-slateBorder rounded-lg text-slate-300 hover:bg-slate-800 transition">"Slowest moving items?"</button>
                    <button onclick="triggerQuickPrompt('Buatkan draft strategi promosi/diskon untuk barang yang stoknya terlalu banyak!')" class="px-2 py-1 bg-[#0B0F19] border border-slateBorder rounded-lg text-slate-300 hover:bg-slate-800 transition">"Draft discount campaign"</button>
                </div>
            </div>
        </div>
    </main>

    <!-- FLOATING AI CHAT WIDGET -->
    <div class="fixed bottom-8 right-8 z-50">
        <button id="toggleChat" class="relative w-14 h-14 bg-indigo-600 hover:bg-indigo-500 text-white rounded-2xl flex items-center justify-center shadow-2xl shadow-indigo-900/50 transition-all transform hover:scale-105 active:scale-95 border border-indigo-400/40">
            <span class="text-2xl">🤖</span>
            <span class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-emerald-400 border-2 border-slateBg rounded-full"></span>
        </button>

        <div id="chatBox" class="hidden absolute bottom-full right-0 mb-3 w-[90vw] sm:w-[420px] bg-slateCard border border-slateBorder rounded-2xl shadow-2xl flex flex-col overflow-hidden backdrop-blur-xl">
            <div class="p-3.5 bg-[#0B0F19] border-b border-slateBorder flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-indigo-950/80 text-indigo-400 rounded-xl border border-indigo-800/40">
                        <span class="text-base">🤖</span>
                    </div>
                    <div>
                        <h4 class="font-headline font-bold text-white text-xs tracking-wide">OmniBot AI Assistant</h4>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span class="text-[10px] text-emerald-400 font-medium">Gemini 3.5 Flash</span>
                        </div>
                    </div>
                </div>
                <button id="closeChat" class="w-7 h-7 flex items-center justify-center text-slate-400 hover:text-white hover:bg-slate-800 rounded-lg transition text-xs">✕</button>
            </div>

            <div id="chatMessages" class="p-4 h-[360px] overflow-y-auto space-y-4 text-xs leading-relaxed custom-scrollbar">
                <div class="bg-[#0B0F19] p-3.5 rounded-xl border border-slateBorder text-slate-300 shadow-sm">
                    Halo! Saya siap menganalisis stok barang kamu. Coba tanyakan: <em class="text-indigo-300">"Barang apa yang stoknya mau habis?"</em>
                </div>
            </div>

            <form id="chatForm" class="p-3 border-t border-slateBorder bg-[#0B0F19]/60 flex gap-2">
                <input type="text" id="chatInput" placeholder="Tanyakan analisis stok ke OmniBot..." class="flex-1 bg-[#0B0F19] border border-slateBorder rounded-xl px-3.5 py-2 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 transition">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-xl text-xs font-semibold shrink-0 transition flex items-center gap-1 shadow-md shadow-indigo-900/20">
                    <span>Kirim</span>
                </button>
            </form>
        </div>
    </div>

    <!-- MODAL 1: ADD PRODUCT -->
    <div id="addProductModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-slateCard border border-slateBorder rounded-2xl w-full max-w-md p-6 shadow-2xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-headline font-bold text-white text-sm">Add New Product</h3>
                <button onclick="closeModal('addProductModal')" class="text-slate-400 hover:text-white">✕</button>
            </div>
            <form id="addProductForm" class="space-y-3 text-xs">
                <div>
                    <label class="block text-slate-400 mb-1">Product Name</label>
                    <input type="text" name="name" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white focus:outline-none">
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-slate-400 mb-1">SKU</label>
                        <input type="text" name="sku" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-slate-400 mb-1">Category</label>
                        <select name="category_id" class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white focus:outline-none">
                            <option value="">General</option>
                            @foreach($categories ?? [] as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-slate-400 mb-1">Stock Quantity</label>
                        <input type="number" name="stock" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-slate-400 mb-1">Min Stock Alert</label>
                        <input type="number" name="min_stock_alert" value="10" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white focus:outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-slate-400 mb-1">Selling Price (Rp)</label>
                    <input type="number" name="selling_price" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white focus:outline-none">
                </div>
                <div class="pt-2 flex justify-end gap-2">
                    <button type="button" onclick="closeModal('addProductModal')" class="px-3 py-1.5 bg-slate-800 text-slate-300 rounded-lg">Cancel</button>
                    <button type="submit" class="px-4 py-1.5 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-lg">Save Product</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL 2: RECORD SALE -->
    <div id="recordSaleModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-slateCard border border-slateBorder rounded-2xl w-full max-w-sm p-6 shadow-2xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-headline font-bold text-white text-sm">Record Transaction Sale</h3>
                <button onclick="closeModal('recordSaleModal')" class="text-slate-400 hover:text-white">✕</button>
            </div>
            <form id="recordSaleForm" class="space-y-3 text-xs">
                <div>
                    <label class="block text-slate-400 mb-1">Select Product</label>
                    <select name="product_id" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white focus:outline-none">
                        @foreach($products ?? [] as $p)
                            <option value="{{ $p->id }}">{{ $p->name }} (Stock: {{ $p->stock }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-slate-400 mb-1">Quantity Sold</label>
                    <input type="number" name="qty" min="1" value="1" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white focus:outline-none">
                </div>
                <div class="pt-2 flex justify-end gap-2">
                    <button type="button" onclick="closeModal('recordSaleModal')" class="px-3 py-1.5 bg-slate-800 text-slate-300 rounded-lg">Cancel</button>
                    <button type="submit" class="px-4 py-1.5 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold rounded-lg">Record Sale</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL 3: EDIT PRODUCT -->
    <div id="editProductModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-slateCard border border-slateBorder rounded-2xl w-full max-w-md p-6 shadow-2xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-headline font-bold text-white text-sm">Edit Product</h3>
                <button onclick="closeModal('editProductModal')" class="text-slate-400 hover:text-white">✕</button>
            </div>
            <form id="editProductForm" class="space-y-3 text-xs">
                <input type="hidden" id="edit_product_id" name="id">
                <div>
                    <label class="block text-slate-400 mb-1">Product Name</label>
                    <input type="text" id="edit_name" name="name" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white focus:outline-none">
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-slate-400 mb-1">SKU</label>
                        <input type="text" id="edit_sku" name="sku" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-slate-400 mb-1">Category</label>
                        <select id="edit_category_id" name="category_id" class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white focus:outline-none">
                            <option value="">General</option>
                            @foreach($categories ?? [] as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-slate-400 mb-1">Stock Quantity</label>
                        <input type="number" id="edit_stock" name="stock" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-slate-400 mb-1">Min Stock Alert</label>
                        <input type="number" id="edit_min_stock_alert" name="min_stock_alert" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white focus:outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-slate-400 mb-1">Selling Price (Rp)</label>
                    <input type="number" id="edit_selling_price" name="selling_price" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white focus:outline-none">
                </div>
                <div class="pt-2 flex justify-end gap-2">
                    <button type="button" onclick="closeModal('editProductModal')" class="px-3 py-1.5 bg-slate-800 text-slate-300 rounded-lg">Cancel</button>
                    <button type="submit" class="px-4 py-1.5 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-lg">Update Product</button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPTS LENGKAP -->
    <script>
        // Modal Handlers
        function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
        function closeModal(id) { document.getElementById(id).classList.add('hidden'); }

        // Chart.js Setup
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [
                    { label: 'Actual Sales', data: [25, 40, 52, 75], borderColor: '#10B981', backgroundColor: 'transparent', borderWidth: 2, tension: 0.4, pointRadius: 0 },
                    { label: 'AI Demand Forecast', data: [15, 30, 48, 62], borderColor: '#64748B', backgroundColor: 'transparent', borderWidth: 1.5, tension: 0.4, pointRadius: 0 }
                ]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: { grid: { color: '#1E293B' }, ticks: { color: '#64748B', font: { size: 10 } } }, y: { grid: { color: '#1E293B' }, ticks: { color: '#64748B', font: { size: 10 } } } } }
        });

        // Chat Toggle Handler
        const toggleBtn = document.getElementById('toggleChat');
        const closeBtn = document.getElementById('closeChat');
        const chatBox = document.getElementById('chatBox');
        toggleBtn.addEventListener('click', () => chatBox.classList.toggle('hidden'));
        closeBtn.addEventListener('click', () => chatBox.classList.add('hidden'));

        // Markdown Formatter Gemini UI Style
        function parseGeminiMarkdown(text) {
            let formatted = text
                .replace(/```([\s\S]*?)```/g, '<pre class="bg-[#080C14] border border-slateBorder rounded-lg p-2.5 my-2 font-mono text-[11px] text-indigo-300 overflow-x-auto"><code>$1</code></pre>')
                .replace(/`([^`]+)`/g, '<code class="bg-[#080C14] border border-slateBorder text-indigo-300 px-1.5 py-0.5 rounded text-[11px] font-mono">$1</code>')
                .replace(/^### (.*$)/gim, '<h3 class="text-xs font-bold text-white mt-2.5 mb-1 font-headline border-b border-slateBorder/50 pb-1">$1</h3>')
                .replace(/^## (.*$)/gim, '<h2 class="text-sm font-bold text-white mt-3 mb-1 font-headline">$1</h2>')
                .replace(/\*\*(.*?)\*\*/g, '<strong class="text-white font-semibold">$1</strong>')
                .replace(/\*(.*?)\*/g, '<em class="text-slate-300">$1</em>')
                .replace(/^\s*[\*\-]\s+(.*$)/gim, '<li class="ml-3.5 list-disc text-slate-300 my-0.5">$1</li>')
                .replace(/^\s*\d+\.\s+(.*$)/gim, '<li class="ml-3.5 list-decimal text-slate-300 my-0.5">$1</li>')
                .replace(/\n/g, '<br>');

            return formatted;
        }

        // Send Chat Handler
        async function sendChatMessage(promptText) {
            const chatMessages = document.getElementById('chatMessages');
            
            chatMessages.innerHTML += `
                <div class="flex justify-end">
                    <div class="bg-indigo-600/30 text-indigo-100 p-3 rounded-2xl rounded-tr-none max-w-[85%] text-right border border-indigo-500/30 shadow-sm">
                        ${promptText}
                    </div>
                </div>`;
            chatMessages.scrollTop = chatMessages.scrollHeight;

            const typingId = 'typing-' + Date.now();
            chatMessages.innerHTML += `
                <div id="${typingId}" class="flex items-start gap-2.5">
                    <div class="p-1.5 bg-indigo-950/80 text-indigo-400 rounded-lg border border-indigo-800/40 text-xs shrink-0">🤖</div>
                    <div class="bg-[#0B0F19] p-3 rounded-2xl rounded-tl-none border border-slateBorder text-slate-400 text-xs flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 bg-indigo-400 rounded-full animate-bounce"></span>
                        <span class="w-1.5 h-1.5 bg-indigo-400 rounded-full animate-bounce [animation-delay:0.2s]"></span>
                        <span class="w-1.5 h-1.5 bg-indigo-400 rounded-full animate-bounce [animation-delay:0.4s]"></span>
                    </div>
                </div>`;
            chatMessages.scrollTop = chatMessages.scrollHeight;

            try {
                const res = await fetch('/ai/ask', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
                    body: JSON.stringify({ prompt: promptText })
                });
                const data = await res.json();
                
                document.getElementById(typingId)?.remove();
                const rawReply = data.reply || data.message || 'Jawaban tidak ditemukan';
                const formattedReply = parseGeminiMarkdown(rawReply);

                chatMessages.innerHTML += `
                    <div class="flex items-start gap-2.5">
                        <div class="p-1.5 bg-indigo-950/80 text-indigo-400 rounded-lg border border-indigo-800/40 text-xs shrink-0">🤖</div>
                        <div class="bg-[#0B0F19] p-3.5 rounded-2xl rounded-tl-none border border-slateBorder text-slate-300 space-y-1 shadow-sm overflow-hidden">
                            ${formattedReply}
                        </div>
                    </div>`;
            } catch (err) {
                document.getElementById(typingId)?.remove();
                chatMessages.innerHTML += `
                    <div class="bg-red-950/80 p-3 rounded-xl border border-red-800 text-red-300">
                        Error menghubungi AI Server.
                    </div>`;
            }
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function triggerQuickPrompt(promptText) {
            chatBox.classList.remove('hidden');
            sendChatMessage(promptText);
        }

        document.getElementById('chatForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const input = document.getElementById('chatInput');
            const text = input.value.trim();
            if (!text) return;
            input.value = '';
            sendChatMessage(text);
        });

        // Live Search Ctrl + K Logic
        const searchInput = document.getElementById('globalSearchInput');
        let searchTimeout;

        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    fetchFilteredData(e.target.value);
                }, 300);
            });
        }

        document.addEventListener('keydown', (e) => {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                searchInput?.focus();
            }
        });

        async function fetchFilteredData(query) {
            try {
                const res = await fetch(`/?search=${encodeURIComponent(query)}`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const data = await res.json();
                
                if (data.status === 'success') {
                    renderTableRows(data.products);
                }
            } catch (err) {
                console.error("Filter error:", err);
            }
        }

        function renderTableRows(products) {
            const tbody = document.querySelector('tbody');
            if (!tbody) return;

            if (products.length === 0) {
                tbody.innerHTML = `<tr><td colspan="6" class="text-center py-4 text-slate-500">Tidak ada produk ditemukan.</td></tr>`;
                return;
            }

            tbody.innerHTML = products.map(p => {
                const minAlert = p.min_stock_alert || 10;
                const percent = Math.min(100, Math.max(0, (p.stock / (minAlert * 3)) * 100));
                const color = p.stock == 0 ? 'bg-red-500' : (p.stock <= minAlert ? 'bg-amber-400' : 'bg-emerald-400');
                const statusBadge = p.stock == 0 
                    ? '<span class="px-2 py-0.5 rounded-full text-[10px] font-medium bg-red-950/60 text-red-400 border border-red-800/40">Out</span>'
                    : (p.stock <= minAlert 
                        ? '<span class="px-2 py-0.5 rounded-full text-[10px] font-medium bg-amber-950/60 text-amber-400 border border-amber-800/40">Low</span>'
                        : '<span class="px-2 py-0.5 rounded-full text-[10px] font-medium bg-emerald-950/60 text-emerald-400 border border-emerald-800/40">In Stock</span>');

                const categoryName = p.category ? p.category.name : 'General';
                const priceFormatted = new Intl.NumberFormat('id-ID').format(p.selling_price);

                return `
                    <tr class="hover:bg-slate-800/20">
                        <td class="py-3 px-3 font-medium text-white">
                            <div>${p.name}</div>
                            <div class="text-[10px] text-slate-500">Rp ${priceFormatted}</div>
                        </td>
                        <td class="py-3 px-3 text-slate-400 font-mono text-[11px]">${p.sku}</td>
                        <td class="py-3 px-3"><span class="bg-slate-800 px-2 py-0.5 rounded text-[10px]">${categoryName}</span></td>
                        <td class="py-3 px-3">
                            <div class="flex items-center gap-3">
                                <div class="w-24 bg-slate-800 h-1 rounded-full overflow-hidden">
                                    <div class="${color} h-full" style="width: ${percent}%"></div>
                                </div>
                                <span class="font-bold text-white text-[11px]">${p.stock}</span>
                            </div>
                        </td>
                        <td class="py-3 px-3">${statusBadge}</td>
                        <td class="py-3 px-3 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button onclick='openEditModal(${JSON.stringify(p)})' class="text-indigo-400 hover:text-indigo-300 font-medium text-xs">Edit</button>
                                <button onclick="deleteProduct(${p.id})" class="text-red-400 hover:text-red-300 font-medium text-xs">Delete</button>
                            </div>
                        </td>
                    </tr>
                `;
            }).join('');
        }

   // AJAX Add Product Form
        document.getElementById('addProductForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData.entries());

            try {
                const res = await fetch('/products/store', {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
                    },
                    body: JSON.stringify(data)
                });

                const result = await res.json();

                if (res.ok && result.status === 'success') {
                    closeModal('addProductModal');
                    location.reload();
                } else {
                    if (result.errors) {
                        const firstError = Object.values(result.errors)[0][0];
                        alert('Gagal: ' + firstError);
                    } else {
                        alert(result.message || 'Gagal menyimpan produk.');
                    }
                }
            } catch (err) {
                console.error(err);
                alert('Terjadi kesalahan pada server. Cek console browser.');
            }
        });

        // AJAX Record Sale Form
        document.getElementById('recordSaleForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData.entries());

            try {
                const res = await fetch('/sales/record', {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json', 
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
                    },
                    body: JSON.stringify(data)
                });

                const result = await res.json();

                if (res.ok && result.status === 'success') {
                    closeModal('recordSaleModal');
                    location.reload();
                } else {
                    alert(result.message || 'Gagal mencatat penjualan.');
                }
            } catch (err) {
                console.error(err);
                alert('Terjadi kesalahan pada server.');
            }
        });

        // Open Modal Edit & Fill Data
        function openEditModal(product) {
            document.getElementById('edit_product_id').value = product.id;
            document.getElementById('edit_name').value = product.name;
            document.getElementById('edit_sku').value = product.sku;
            document.getElementById('edit_category_id').value = product.category_id || '';
            document.getElementById('edit_stock').value = product.stock;
            document.getElementById('edit_min_stock_alert').value = product.min_stock_alert;
            document.getElementById('edit_selling_price').value = product.selling_price;
            openModal('editProductModal');
        }

        // Handle Form Submit Update Product
        document.getElementById('editProductForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const id = document.getElementById('edit_product_id').value;
            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData.entries());

            try {
                const res = await fetch(`/products/${id}`, {
                    method: 'PUT',
                    headers: { 
                        'Content-Type': 'application/json', 
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
                    },
                    body: JSON.stringify(data)
                });

                const result = await res.json();

                if (res.ok && result.status === 'success') {
                    closeModal('editProductModal');
                    location.reload();
                } else {
                    if (result.errors) {
                        const firstError = Object.values(result.errors)[0][0];
                        alert('Gagal Update: ' + firstError);
                    } else {
                        alert(result.message || 'Gagal memperbarui produk.');
                    }
                }
            } catch (err) {
                console.error(err);
                alert('Terjadi kesalahan pada server.');
            }
        });

        // Handle Delete Product
        async function deleteProduct(id) {
            if (!confirm('Apakah kamu yakin ingin menghapus produk ini?')) return;

            try {
                const res = await fetch(`/products/${id}`, {
                    method: 'DELETE',
                    headers: { 
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
                    }
                });

                if (res.ok) {
                    location.reload();
                } else {
                    alert('Gagal menghapus produk.');
                }
            } catch (err) {
                console.error(err);
                alert('Terjadi kesalahan pada server.');
            }
        }
    </script>
</body>
</html>