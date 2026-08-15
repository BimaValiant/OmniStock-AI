<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>OmniStock AI - Reports</title>

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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-slateBg text-slate-300 antialiased font-sans min-h-screen flex selection:bg-slate-700 selection:text-white">
    <aside class="w-64 bg-[#0d1322] border-r border-gray-800/80 min-h-screen p-5 flex flex-col justify-between select-none">
        <div>
            <div class="flex items-center gap-3 px-2 mb-8">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center font-black text-white text-lg shadow-lg shadow-blue-500/20 tracking-wider">
                    OS
                </div>
                <div>
                    <h1 class="font-bold text-white text-base tracking-wide leading-tight">OmniStock AI</h1>
                    <p class="text-[11px] font-medium text-gray-500">Enterprise Command</p>
                </div>
            </div>

            <nav class="space-y-1.5">
                <a href="{{ url('/') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ url('/inventory') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Inventory
                </a>
                <a href="{{ url('/transactions') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z"></path>
                    </svg>
                    Transactions
                </a>
                <a href="{{ url('/stock-movements') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Stock Movements
                </a>
                <a href="{{ url('/purchase-orders') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Purchase Orders
                </a>
                <a href="{{ url('/suppliers') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Suppliers
                </a>
                <a href="{{ url('/reports') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('reports') ? 'bg-slate-700/60 text-white font-semibold shadow-sm' : 'text-gray-400 hover:bg-gray-800/50 hover:text-gray-200' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Reports
                </a>
                <a href="{{ url('/settings') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Settings
                </a>
            </nav>
        </div>
    </aside>

    <main class="flex-1 p-6 md:p-8 overflow-y-auto">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div class="relative w-full sm:w-80">
                <input type="text" placeholder="Search reports, customers, or products" class="w-full bg-[#111622] border border-slateBorder/80 rounded-lg py-1.5 pl-8 pr-12 text-xs text-slate-200 focus:outline-none focus:border-slate-500 placeholder-slate-500">
                <span class="absolute left-2.5 top-2 text-slate-500 text-xs">🔍</span>
                <span class="absolute right-2.5 top-1.5 text-[10px] text-slate-500 border border-slateBorder px-1 py-0.2 rounded bg-slateBg">Ctrl+K</span>
            </div>

            <div class="flex items-center gap-2.5">
                <button class="bg-[#212938] border border-slate-600/50 hover:bg-slate-700 text-white text-xs font-medium px-3.5 py-1.5 rounded-lg flex items-center gap-1.5 transition">
                    <span>+</span> Add Product
                </button>
                <button class="px-4 py-2 bg-[#131722] hover:bg-gray-800 border border-gray-800 rounded-xl text-xs font-semibold text-gray-200 transition-all">
                    📄 Record Sale
                </button>
                <button class="p-1.5 bg-[#18202F] border border-slateBorder rounded-lg text-slate-400 hover:text-slate-200">🔔</button>
                <button class="p-1.5 bg-[#18202F] border border-slateBorder rounded-lg text-slate-400 hover:text-slate-200">🕒</button>
            </div>
        </div>

        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="font-headline font-bold text-2xl text-white tracking-tight">Reports & Analytics</h1>
                <p class="text-xs text-slate-400 mt-0.5">Monitor revenue, inventory, and operational performance.</p>
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

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-slateCard border border-slateBorder rounded-xl p-4 relative">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total Revenue</p>
                <h2 class="font-headline text-2xl font-extrabold text-white mb-2">Rp {{ number_format($totalSales, 0, ',', '.') }}</h2>
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
                    <span class="font-headline text-2xl font-extrabold text-white">{{ $lowStockCount }}</span>
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <div class="lg:col-span-2 bg-slateCard border border-slateBorder rounded-xl p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between mb-2">
                    <div>
                        <h3 class="font-headline font-bold text-white text-sm">Sales Performance</h3>
                        <p class="text-[11px] text-slate-400">30-day trailing projection</p>
                    </div>
                    <button class="text-slate-500 hover:text-slate-300">⋮</button>
                </div>
                <div class="h-56 w-full relative">
                    <canvas id="reportsChart"></canvas>
                </div>
            </div>

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
                            <strong class="text-slate-100">Attention:</strong> {{ $lowStockCount }} items predicted to run out based on current velocity.
                        </p>
                    </div>
                </div>

                <div>
                    <p class="text-[11px] text-slate-400 mb-2 font-medium">Recommended Action</p>
                    <button class="w-full bg-slate-200 hover:bg-white text-slate-900 font-semibold text-xs py-2 rounded-lg flex items-center justify-center gap-1.5 transition">
                        Generate Purchase Order <span>→</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-slateCard border border-slateBorder rounded-xl p-5">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <span class="text-slate-400">📦</span>
                    <h3 class="font-headline font-bold text-white text-sm">Recent Transactions</h3>
                </div>
                <div class="flex items-center gap-2">
                    <button class="bg-[#0B0F19] border border-slateBorder text-xs text-slate-300 px-2.5 py-1 rounded-lg hover:bg-slate-800 transition">Filter</button>
                    <button class="bg-[#0B0F19] border border-slateBorder text-xs text-slate-300 px-2.5 py-1 rounded-lg hover:bg-slate-800 transition">Export CSV</button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-300">
                    <thead class="text-[10px] text-slate-400 uppercase bg-[#0B0F19]/60 border-b border-slateBorder">
                        <tr>
                            <th class="py-2.5 px-3">INVOICE</th>
                            <th class="py-2.5 px-3">ITEMS</th>
                            <th class="py-2.5 px-3">AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slateBorder/40">
                        @forelse($recentTransactions as $transaction)
                            <tr class="hover:bg-slate-800/20">
                                <td class="py-3 px-3 font-medium text-white">{{ $transaction->invoice_code }}</td>
                                <td class="py-3 px-3 text-slate-300">
                                    @foreach($transaction->details as $detail)
                                        {{ $detail->product->name ?? 'Unknown' }} ({{ $detail->qty }})@if(!$loop->last), @endif
                                    @endforeach
                                </td>
                                <td class="py-3 px-3 text-emerald-400 font-semibold">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-10 text-center text-slate-400">No recent transactions.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        const ctx = document.getElementById('reportsChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'Sales (Rp)',
                    data: [1500000, 3200000, 4800000, 6100000],
                    backgroundColor: ['#dbeafe', '#93c5fd', '#60a5fa', '#3b82f6'],
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: { grid: { color: '#1E293B' }, ticks: { color: '#94a3b8' } },
                    y: { grid: { color: '#1E293B' }, ticks: { color: '#94a3b8' } }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    </script>
</body>
</html>
