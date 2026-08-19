<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>OmniStock AI - Reports & Analytics</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
                <a href="{{ url('/inventory') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    Inventory
                </a>
                <a href="{{ url('/transactions') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z"></path></svg>
                    Transactions
                </a>
                <a href="{{ url('/stock-movements') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    Stock Movements
                </a>
                <a href="{{ url('/purchase-orders') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Purchase Orders
                </a>
                <a href="{{ url('/suppliers') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Suppliers
                </a>
                <a href="{{ url('/reports') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 bg-slate-700/60 text-white font-semibold shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Reports
                </a>
                <a href="{{ url('/settings') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Settings
                </a>
            </nav>
        </div>
    </aside>

    <main class="flex-1 p-6 md:p-8 overflow-y-auto">
        <!-- HEADER & ACTIONS -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <div>
                <h1 class="font-headline font-bold text-2xl text-white tracking-tight">Reports & Analytics</h1>
                <p class="text-xs text-slate-400 mt-0.5">Comprehensive financial and inventory performance metrics.</p>
            </div>
            <div class="flex items-center gap-3">
                <select id="timeFilter" class="bg-[#111622] border border-slateBorder text-xs text-white rounded-xl px-3 py-2 focus:outline-none">
                    <option value="this_month">This Month</option>
                    <option value="last_30_days">Last 30 Days</option>
                    <option value="this_year">This Year</option>
                </select>
                <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-500 text-white font-semibold text-xs px-3.5 py-2 rounded-xl transition flex items-center gap-1.5">
                    📄 Print / Export PDF
                </button>
            </div>
        </div>

       <!-- SUMMARY CARDS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <!-- Total Revenue / Omset -->
            <div class="bg-slateCard border border-slateBorder rounded-xl p-4">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total Revenue</p>
                <h2 class="font-headline text-2xl font-extrabold text-white mb-2">Rp {{ number_format($totalSales ?? 0, 0, ',', '.') }}</h2>
                <div class="flex items-center gap-1.5 text-[11px]">
                    <span class="bg-emerald-950/60 text-emerald-400 px-1.5 py-0.2 rounded font-semibold border border-emerald-800/40">Sales</span>
                    <span class="text-slate-500">Total Omset</span>
                </div>
            </div>

            <!-- Total HPP / Modal -->
            <div class="bg-slateCard border border-slateBorder rounded-xl p-4">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total HPP (Modal)</p>
                <h2 class="font-headline text-2xl font-extrabold text-slate-300 mb-2">Rp {{ number_format($totalCost ?? 0, 0, ',', '.') }}</h2>
                <div class="flex items-center gap-1.5 text-[11px]">
                    <span class="bg-slate-800 text-slate-300 px-1.5 py-0.2 rounded font-semibold border border-slate-700">Cost</span>
                    <span class="text-slate-500">Modal Barang Terjual</span>
                </div>
            </div>

            <!-- Net Profit / Laba Bersih -->
            <div class="bg-slateCard border border-slateBorder rounded-xl p-4">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Net Profit (Laba Bersih)</p>
                <h2 class="font-headline text-2xl font-extrabold text-emerald-400 mb-2">Rp {{ number_format($netProfit ?? 0, 0, ',', '.') }}</h2>
                <div class="flex items-center gap-1.5 text-[11px]">
                    <span class="bg-emerald-950/60 text-emerald-400 px-1.5 py-0.2 rounded font-semibold border border-emerald-800/40">Profit</span>
                    <span class="text-slate-500">Omset - HPP Modal</span>
                </div>
            </div>

            <!-- Profit Margin % -->
            <div class="bg-slateCard border border-slateBorder rounded-xl p-4">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Profit Margin</p>
                <h2 class="font-headline text-2xl font-extrabold text-blue-400 mb-2">{{ $avgMargin ?? 0 }}%</h2>
                <div class="flex items-center gap-1.5 text-[11px]">
                    <span class="bg-blue-950/60 text-blue-400 px-1.5 py-0.2 rounded font-semibold border border-blue-800/40">Margin</span>
                    <span class="text-slate-500">Rata-rata Margin</span>
                </div>
            </div>
        </div>

        <!-- ANALYTICS SECTION -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- CHART -->
            <div class="lg:col-span-2 bg-slateCard border border-slateBorder rounded-xl p-5">
                <h3 class="font-headline font-bold text-white text-sm mb-4">Revenue & Sales Performance Trend</h3>
                <div class="h-64">
                    <canvas id="reportsChart"></canvas>
                </div>
            </div>

            <!-- TOP PRODUCTS -->
            <div class="bg-slateCard border border-slateBorder rounded-xl p-5">
                <h3 class="font-headline font-bold text-white text-sm mb-4">Top Performing Products</h3>
                <div class="space-y-3">
                    @forelse($topProducts ?? [] as $tp)
                        <div class="flex items-center justify-between text-xs p-2.5 rounded-lg bg-[#0f1420] border border-slateBorder/60">
                            <div>
                                <p class="font-semibold text-white">{{ $tp->product->name ?? 'Deleted Item' }}</p>
                                <p class="text-[10px] text-slate-400">{{ $tp->total_qty }} units sold</p>
                            </div>
                            <span class="font-bold text-emerald-400">Rp {{ number_format($tp->total_revenue, 0, ',', '.') }}</span>
                        </div>
                    @empty
                        <p class="text-xs text-slate-500 text-center py-4">Belum ada data penjualan aktif.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </main>

    <script>
        const ctx = document.getElementById('reportsChart').getContext('2d');
        const realtimeData = @json($chartData);
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Wk 1 (1-7)', 'Wk 2 (8-14)', 'Wk 3 (15-21)', 'Wk 4 (22+)'],
                datasets: [{
                    label: 'Revenue (Rp)',
                    data: realtimeData,
                    backgroundColor: ['#3b82f6', '#60a5fa', '#93c5fd', '#2563eb'],
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { 
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let value = context.parsed.y || 0;
                                return ' Revenue: Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    x: { grid: { display: false }, ticks: { color: '#94a3b8' } },
                    y: { 
                        grid: { color: '#1e293b' }, 
                        ticks: { 
                            color: '#94a3b8',
                            callback: function(value) {
                                return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                            }
                        } 
                    }
                }
            }
        });
    </script>
</body>
</html>