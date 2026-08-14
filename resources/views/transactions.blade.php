<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OmniStock AI - Transactions</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#0c0e17] text-gray-200 min-h-screen flex selection:bg-blue-600 selection:text-white">

    <!-- Sidebar Left Bar (Persis Warna Dashboard Utama) -->
    <aside class="w-64 bg-[#090b11] border-r border-gray-800/60 p-5 flex flex-col justify-between shrink-0 min-h-screen">
        <div>
            <!-- Brand Logo -->
            <div class="flex items-center gap-3 px-2 mb-8">
                <div class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center font-bold text-white shadow-lg shadow-blue-500/20 text-sm">
                    OS
                </div>
                <div>
                    <h1 class="font-bold text-white text-sm tracking-tight leading-none">OmniStock AI</h1>
                    <p class="text-[11px] font-medium text-gray-500 mt-1">Enterprise Command</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-1.5">
                <!-- Dashboard Link -->
                <a href="{{ url('/') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-[#131722] hover:text-white transition-all">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>

                <!-- Inventory Link -->
                <a href="{{ url('/') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-[#131722] hover:text-white transition-all">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    Inventory
                </a>

                <!-- Active Link: Transactions -->
                <a href="{{ url('/transactions') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold text-white bg-[#1f293d] shadow-sm transition-all">
                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z"></path></svg>
                    Transactions
                </a>

                <!-- Suppliers Link -->
                <a href="#" onclick="alert('Menu Suppliers sedang dalam pengembangan!')" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-[#131722] hover:text-white transition-all">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Suppliers
                </a>

                <!-- Reports Link -->
                <a href="#" onclick="alert('Menu Reports sedang dalam pengembangan!')" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-[#131722] hover:text-white transition-all">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Reports
                </a>

                <!-- Settings Link -->
                <a href="#" onclick="alert('Menu Settings sedang dalam pengembangan!')" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-[#131722] hover:text-white transition-all">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Settings
                </a>
            </nav>
        </div>

        <!-- Footer Profile/Support -->
        <div class="pt-6 border-t border-gray-800/60 space-y-2">
            <a href="#" class="flex items-center gap-3 px-3.5 py-2 text-xs font-medium text-gray-400 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Support
            </a>
            <a href="#" class="flex items-center gap-3 px-3.5 py-2 text-xs font-medium text-gray-400 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Logout
            </a>
        </div>
    </aside>

    <!-- Main Container -->
    <div class="flex-1 flex flex-col min-w-0">
        
        <!-- Header Top Search & Back Button -->
        <header class="h-16 border-b border-gray-800/60 px-8 flex items-center justify-between bg-[#0c0e17] sticky top-0 z-20">
            <div class="flex items-center gap-4">
                <!-- Tombol Back ke Dashboard -->
                <a href="{{ url('/') }}" class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-[#131722] hover:bg-gray-800 border border-gray-800 text-xs font-medium text-gray-300 transition-all">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Dashboard
                </a>

                <!-- Search Box -->
                <div class="relative w-80">
                    <svg class="w-4 h-4 text-gray-500 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" placeholder="Search inventory, sales, insights..." class="w-full bg-[#131722] border border-gray-800/80 rounded-xl py-1.5 pl-10 pr-12 text-xs text-gray-200 placeholder-gray-500 focus:outline-none focus:border-blue-500 transition-all">
                    <span class="absolute right-3 top-1/2 -translate-y-1/2 px-1.5 py-0.5 text-[10px] font-semibold text-gray-500 bg-gray-800/80 rounded border border-gray-700/50">Ctrl+K</span>
                </div>
            </div>

            <!-- Header Right Badges -->
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> System Online
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20">
                    Just updated
                </span>
            </div>
        </header>

        <!-- Main Content Workspace -->
        <main class="flex-1 p-8 space-y-6 overflow-y-auto">
            
            <!-- Title Header -->
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-white tracking-tight">Transaction History</h2>
                    <p class="text-xs text-gray-400 mt-1">Real-time overview of recorded sales and inventory movement.</p>
                </div>
            </div>

            <!-- Metric Cards (Sama Warna Dashboard) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="bg-[#131722] border border-gray-800/80 rounded-2xl p-5 flex items-center justify-between shadow-xl">
                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-wider text-gray-400">TOTAL VOLUME</p>
                        <h3 class="text-2xl font-bold text-white mt-1">Rp {{ number_format($transactions->sum('total_amount'), 0, ',', '.') }}</h3>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400 font-bold">
                        Rp
                    </div>
                </div>

                <div class="bg-[#131722] border border-gray-800/80 rounded-2xl p-5 flex items-center justify-between shadow-xl">
                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-wider text-gray-400">TOTAL TRANSACTIONS</p>
                        <h3 class="text-2xl font-bold text-white mt-1">{{ $transactions->count() }} items</h3>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>

                <div class="bg-[#131722] border border-gray-800/80 rounded-2xl p-5 flex items-center justify-between shadow-xl">
                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-wider text-gray-400">STATUS</p>
                        <h3 class="text-2xl font-bold text-emerald-400 mt-1">100% Synced</h3>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Table Wrapper (Presisi Warna Dashboard) -->
            <div class="bg-[#131722] border border-gray-800/80 rounded-2xl overflow-hidden shadow-2xl">
                
                <div class="p-4 border-b border-gray-800/80 flex items-center justify-between bg-[#0e111a]">
                    <div class="flex items-center gap-2">
                        <button class="px-3 py-1.5 rounded-lg bg-gray-800 text-white font-semibold text-xs border border-gray-700">All</button>
                        <button class="px-3 py-1.5 rounded-lg text-gray-400 hover:text-white font-medium text-xs transition-all">Sales</button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-gray-300">
                        <thead class="bg-[#0b0e17] text-gray-400 uppercase tracking-wider text-[11px] font-semibold border-b border-gray-800/80">
                            <tr>
                                <th class="px-6 py-3.5">Date / Time</th>
                                <th class="px-6 py-3.5">Invoice Code</th>
                                <th class="px-6 py-3.5">Items Purchased</th>
                                <th class="px-6 py-3.5">Total Amount</th>
                                <th class="px-6 py-3.5">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800/60 font-medium">
                            @forelse($transactions as $trx)
                                <tr class="hover:bg-gray-800/30 transition-colors">
                                    <td class="px-6 py-4 text-gray-400">
                                        <div class="text-gray-200 font-semibold">{{ $trx->created_at->format('M d, Y') }}</div>
                                        <div class="text-[11px] text-gray-500 mt-0.5">{{ $trx->created_at->format('H:i:s') }} WIB</div>
                                    </td>
                                    <td class="px-6 py-4 font-mono text-blue-400 font-semibold">
                                        {{ $trx->invoice_code }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @foreach($trx->details as $detail)
                                            <div class="text-gray-200 font-semibold">• {{ $detail->product->name ?? 'Deleted Item' }} <span class="text-blue-400 font-mono text-[11px] ml-1">(x{{ $detail->qty }})</span></div>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 text-gray-100 font-bold font-mono text-sm">
                                        Rp {{ number_format($trx->total_amount, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                            Completed
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                        Belum ada data transaksi penjualan yang dicatat.
                                    </td>
                                </tr>
                            @endempty
                        </tbody>
                    </table>
                </div>

            </div>

        </main>
    </div>

</body>
</html>