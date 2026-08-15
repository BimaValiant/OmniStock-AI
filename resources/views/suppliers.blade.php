<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>OmniStock AI - Suppliers</title>

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
                    <a href="{{ url('/inventory') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
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
                    <a href="{{ url('/suppliers') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('suppliers') ? 'bg-slate-700/60 text-white font-semibold shadow-sm' : 'text-gray-400 hover:bg-gray-800/50 hover:text-gray-200' }}">
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
                    <input type="text" placeholder="Search suppliers..." class="w-full bg-[#111622] border border-slateBorder/80 rounded-lg py-2 pl-9 pr-3 text-xs text-slate-200 focus:outline-none focus:border-slate-500 placeholder-slate-500">
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
                        <h1 class="font-headline font-bold text-2xl text-white tracking-tight">Supplier Directory</h1>
                        <p class="text-xs text-slate-400 mt-0.5">Manage your global network and monitor performance metrics.</p>
                    </div>
                    <button class="bg-slate-200 hover:bg-white text-slate-900 font-semibold text-xs px-3.5 py-1.5 rounded-lg transition flex-shrink-0">Add Supplier</button>
                </div>

                <div class="mb-5 flex items-center gap-2 flex-wrap">
                    <button class="px-3 py-1.5 text-xs bg-[#111622] border border-slateBorder rounded-lg text-slate-200 hover:bg-[#1a1f2e] transition">All Categories</button>
                    <button class="px-3 py-1.5 text-xs bg-[#111622] border border-slateBorder rounded-lg text-slate-200 hover:bg-[#1a1f2e] transition">Performance: High to Low</button>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                    @forelse($suppliers as $supplier)
                        <div class="bg-slateCard border border-slateBorder rounded-xl p-5 flex flex-col">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-10 h-10 rounded-xl bg-[#1b2430] border border-[#2a2f3a] flex items-center justify-center text-xs font-bold text-gray-200 flex-shrink-0">{{ strtoupper(substr($supplier->name, 0, 2)) }}</div>
                                    <div class="min-w-0">
                                        <h3 class="font-medium text-white truncate">{{ $supplier->name }}</h3>
                                        <div class="text-[11px] text-slate-400 mt-1 truncate">{{ $supplier->contact_person ?? 'Vendor' }}</div>
                                    </div>
                                </div>
                                <div class="text-[10px] font-semibold text-slate-200 flex-shrink-0 ml-2">★ 4.9</div>
                            </div>
                            <div class="grid grid-cols-2 gap-3 border-t border-slateBorder pt-4 text-[10px] text-slate-400 flex-1">
                                <div>
                                    <div class="uppercase tracking-wide text-[9px] text-slate-500">Active Orders</div>
                                    <div class="mt-1 text-sm font-semibold text-white">{{ $supplier->active_orders ?? 12 }}</div>
                                </div>
                                <div>
                                    <div class="uppercase tracking-wide text-[9px] text-slate-500">Avg Lead Time</div>
                                    <div class="mt-1 text-sm font-semibold text-white">{{ $supplier->avg_lead_time ?? '3-5 days' }}</div>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center justify-between text-[10px] text-slate-400 border-t border-slateBorder pt-4">
                                <span class="truncate">{{ $supplier->address ?? 'Global Supplier' }}</span>
                                <button class="text-slate-200 font-semibold flex-shrink-0 ml-2">Details →</button>
                            </div>
                        </div>
                    @empty
                        <div class="bg-slateCard border border-slateBorder rounded-xl p-5 flex flex-col">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-10 h-10 rounded-xl bg-[#1b2430] border border-[#2a2f3a] flex items-center justify-center text-xs font-bold text-gray-200 flex-shrink-0">AE</div>
                                    <div class="min-w-0">
                                        <h3 class="font-medium text-white truncate">Apex Electronics</h3>
                                        <div class="text-[11px] text-slate-400 mt-1 truncate">Semiconductors</div>
                                    </div>
                                </div>
                                <div class="text-[10px] font-semibold text-slate-200 flex-shrink-0 ml-2">★ 4.9</div>
                            </div>
                            <div class="grid grid-cols-2 gap-3 border-t border-slateBorder pt-4 text-[10px] text-slate-400 flex-1">
                                <div>
                                    <div class="uppercase tracking-wide text-[9px] text-slate-500">Active Orders</div>
                                    <div class="mt-1 text-sm font-semibold text-white">14</div>
                                </div>
                                <div>
                                    <div class="uppercase tracking-wide text-[9px] text-slate-500">Avg Lead Time</div>
                                    <div class="mt-1 text-sm font-semibold text-white">3–5 days</div>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center justify-between text-[10px] text-slate-400 border-t border-slateBorder pt-4">
                                <span class="truncate">Shenzhen, CN</span>
                                <button class="text-slate-200 font-semibold flex-shrink-0 ml-2">Details →</button>
                            </div>
                        </div>
                        <div class="bg-slateCard border border-slateBorder rounded-xl p-5 flex flex-col">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-10 h-10 rounded-xl bg-[#1b2430] border border-[#2a2f3a] flex items-center justify-center text-xs font-bold text-gray-200 flex-shrink-0">GP</div>
                                    <div class="min-w-0">
                                        <h3 class="font-medium text-white truncate">Global Packaging</h3>
                                        <div class="text-[11px] text-slate-400 mt-1 truncate">Materials</div>
                                    </div>
                                </div>
                                <div class="text-[10px] font-semibold text-slate-200 flex-shrink-0 ml-2">★ 4.5</div>
                            </div>
                            <div class="grid grid-cols-2 gap-3 border-t border-slateBorder pt-4 text-[10px] text-slate-400 flex-1">
                                <div>
                                    <div class="uppercase tracking-wide text-[9px] text-slate-500">Active Orders</div>
                                    <div class="mt-1 text-sm font-semibold text-white">8</div>
                                </div>
                                <div>
                                    <div class="uppercase tracking-wide text-[9px] text-slate-500">Avg Lead Time</div>
                                    <div class="mt-1 text-sm font-semibold text-white">7–10 days</div>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center justify-between text-[10px] text-slate-400 border-t border-slateBorder pt-4">
                                <span class="truncate">Chicago, US</span>
                                <button class="text-slate-200 font-semibold flex-shrink-0 ml-2">Details →</button>
                            </div>
                        </div>
                        <div class="bg-slateCard border border-slateBorder rounded-xl p-5 flex flex-col">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-10 h-10 rounded-xl bg-[#1b2430] border border-[#2a2f3a] flex items-center justify-center text-xs font-bold text-gray-200 flex-shrink-0">DS</div>
                                    <div class="min-w-0">
                                        <h3 class="font-medium text-white truncate">Diversify Supply</h3>
                                        <div class="text-[11px] text-slate-400 mt-1 truncate">Logistics</div>
                                    </div>
                                </div>
                                <div class="text-[10px] font-semibold text-slate-200 flex-shrink-0 ml-2">★ 4.4</div>
                            </div>
                            <div class="grid grid-cols-2 gap-3 border-t border-slateBorder pt-4 text-[10px] text-slate-400 flex-1">
                                <div>
                                    <div class="uppercase tracking-wide text-[9px] text-slate-500">Active Orders</div>
                                    <div class="mt-1 text-sm font-semibold text-white">11</div>
                                </div>
                                <div>
                                    <div class="uppercase tracking-wide text-[9px] text-slate-500">Avg Lead Time</div>
                                    <div class="mt-1 text-sm font-semibold text-white">5–8 days</div>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center justify-between text-[10px] text-slate-400 border-t border-slateBorder pt-4">
                                <span class="truncate">Singapore</span>
                                <button class="text-slate-200 font-semibold flex-shrink-0 ml-2">Details →</button>
                            </div>
                        </div>
                    @endforelse
                </div>
            </main>
        </div>
    </div>
</body>
</html>
