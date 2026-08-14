<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OmniStock AI - Supplier Directory</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#0c0e17] text-gray-200 min-h-screen flex selection:bg-blue-600 selection:text-white">

    <!-- Sidebar Left Bar -->
    <aside class="w-64 bg-[#090b11] border-r border-gray-800/60 p-5 flex flex-col justify-between shrink-0 min-h-screen">
        <div>
            <!-- Brand Logo -->
            <div class="flex items-center gap-3 px-2 mb-6">
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
                <a href="{{ url('/') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-[#131722] hover:text-white transition-all">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Inventory
                </a>

                <a href="{{ url('/transactions') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-[#131722] hover:text-white transition-all">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z"></path></svg>
                    Transactions
                </a>

                <!-- Active Link: Suppliers -->
                <a href="{{ url('/suppliers') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold text-white bg-[#1f293d] shadow-sm transition-all">
                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Suppliers
                </a>

                <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-[#131722] hover:text-white transition-all">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Reports
                </a>

                <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-[#131722] hover:text-white transition-all">
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
        
        <!-- Header Utility Bar -->
        <header class="h-16 border-b border-gray-800/60 px-8 flex items-center justify-between bg-[#0c0e17] sticky top-0 z-20">
            <a href="{{ url('/') }}" class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-[#131722] hover:bg-gray-800 border border-gray-800 text-xs font-medium text-gray-300 transition-all">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Dashboard
            </a>

            <div class="flex items-center gap-3">
                <div class="relative w-64">
                    <svg class="w-4 h-4 text-gray-500 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" placeholder="Search suppliers..." class="w-full bg-[#131722] border border-gray-800 rounded-xl py-1.5 pl-9 pr-3 text-xs text-gray-200 placeholder-gray-500 focus:outline-none focus:border-blue-500 transition-all">
                </div>

                <button onclick="document.getElementById('modalAddSupplier').classList.remove('hidden')" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white font-semibold text-xs rounded-xl shadow-lg shadow-blue-600/20 transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Add Supplier
                </button>
            </div>
        </header>

        <!-- Content Workspace Area -->
        <main class="flex-1 p-8 space-y-6 overflow-y-auto">
            
            <!-- Title Header -->
            <div>
                <h2 class="text-2xl font-bold text-white tracking-tight">Supplier Directory</h2>
                <p class="text-xs text-gray-400 mt-1">Manage your global network and monitor performance metrics.</p>
            </div>

            <!-- Filter Controls Bar -->
            <div class="flex items-center gap-3">
                <button class="px-3.5 py-1.5 bg-[#131722] border border-gray-800 rounded-xl text-xs font-semibold text-gray-300 flex items-center gap-2">
                    All Categories
                    <svg class="w-3 h-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <button class="px-3.5 py-1.5 bg-[#131722] border border-gray-800 rounded-xl text-xs font-semibold text-gray-300 flex items-center gap-2">
                    Performance: High to Low
                    <svg class="w-3 h-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.447.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"></path></svg>
                </button>
            </div>

            <!-- Main Cards Layout Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Dynamic Suppliers Cards from DB -->
                @forelse($suppliers as $supplier)
                    <div class="bg-[#131722] border border-gray-800/80 rounded-2xl p-5 space-y-4 shadow-xl hover:border-gray-700 transition-all relative group">
                        
                        <!-- Top Header: Company Name & Rating -->
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-gray-800/90 border border-gray-700/80 flex items-center justify-center font-bold text-blue-400 text-sm">
                                    {{ strtoupper(substr($supplier->name, 0, 2)) }}
                                </div>
                                <div>
                                    <h3 class="font-bold text-white text-sm leading-snug">{{ $supplier->name }}</h3>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-[10px] font-semibold px-2 py-0.5 rounded bg-gray-800 text-gray-300 border border-gray-700">Vendor</span>
                                        <span class="text-[10px] font-semibold text-emerald-400">Top Tier</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-1 text-amber-400 font-bold text-xs">
                                ★ 4.9
                            </div>
                        </div>

                        <!-- Stats Row -->
                        <div class="grid grid-cols-2 gap-2 pt-2 border-t border-gray-800/60">
                            <div>
                                <p class="text-[10px] font-semibold text-gray-500 uppercase">CONTACT PERSON</p>
                                <p class="text-xs font-bold text-gray-200 mt-0.5">{{ $supplier->contact_person ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-semibold text-gray-500 uppercase">AVG LEAD TIME</p>
                                <p class="text-xs font-bold text-emerald-400 mt-0.5">⚡ 3–5 days</p>
                            </div>
                        </div>

                        <!-- Location & Actions -->
                        <div class="flex items-center justify-between pt-2 text-xs">
                            <span class="text-gray-400 flex items-center gap-1 text-[11px]">
                                📍 {{ $supplier->address ?? 'Global Supplier' }}
                            </span>
                            <button onclick="deleteSupplier({{ $supplier->id }})" class="text-red-400 hover:text-red-300 font-semibold text-xs transition-colors">
                                Delete →
                            </button>
                        </div>
                    </div>
                @empty
                    <!-- Fallback Static Cards when DB is Empty -->
                    <div class="bg-[#131722] border border-gray-800/80 rounded-2xl p-5 space-y-4 shadow-xl">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center font-bold text-emerald-400 text-sm">
                                    AE
                                </div>
                                <div>
                                    <h3 class="font-bold text-white text-sm leading-snug">Apex Electronics</h3>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-[10px] font-semibold px-2 py-0.5 rounded bg-gray-800 text-gray-300 border border-gray-700">Semiconductors</span>
                                        <span class="text-[10px] font-semibold text-emerald-400">Top Tier</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-1 text-amber-400 font-bold text-xs">
                                ★ 4.9
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-2 pt-2 border-t border-gray-800/60">
                            <div>
                                <p class="text-[10px] font-semibold text-gray-500 uppercase">ACTIVE ORDERS</p>
                                <p class="text-sm font-bold text-white mt-0.5">14</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-semibold text-gray-500 uppercase">AVG LEAD TIME</p>
                                <p class="text-sm font-bold text-emerald-400 mt-0.5">⚡ 3–5 days</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-2 text-xs">
                            <span class="text-gray-400 flex items-center gap-1 text-[11px]">
                                📍 Shenzhen, CN
                            </span>
                            <a href="#" class="text-blue-400 hover:text-blue-300 font-semibold text-xs">Details →</a>
                        </div>
                    </div>

                    <div class="bg-[#131722] border border-gray-800/80 rounded-2xl p-5 space-y-4 shadow-xl">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center font-bold text-blue-400 text-sm">
                                    GP
                                </div>
                                <div>
                                    <h3 class="font-bold text-white text-sm leading-snug">Global Packaging Solutions</h3>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-[10px] font-semibold px-2 py-0.5 rounded bg-gray-800 text-gray-300 border border-gray-700">Materials</span>
                                        <span class="text-[10px] font-semibold text-blue-400">Reliable</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-1 text-amber-400 font-bold text-xs">
                                ★ 4.5
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-2 pt-2 border-t border-gray-800/60">
                            <div>
                                <p class="text-[10px] font-semibold text-gray-500 uppercase">ACTIVE ORDERS</p>
                                <p class="text-sm font-bold text-white mt-0.5">8</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-semibold text-gray-500 uppercase">AVG LEAD TIME</p>
                                <p class="text-sm font-bold text-gray-200 mt-0.5">7–10 days</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-2 text-xs">
                            <span class="text-gray-400 flex items-center gap-1 text-[11px]">
                                📍 Chicago, US
                            </span>
                            <a href="#" class="text-blue-400 hover:text-blue-300 font-semibold text-xs">Details →</a>
                        </div>
                    </div>
                @endforelse

                <!-- AI Network Optimization Card (Presisi 100% Sesuai Gambar) -->
                <div class="bg-[#131722] border border-gray-800/80 rounded-2xl p-5 flex flex-col justify-between shadow-xl relative overflow-hidden">
                    <div class="space-y-3">
                        <div class="flex items-center gap-2 text-blue-400 font-bold text-[10px] uppercase tracking-wider">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            NETWORK OPTIMIZATION
                        </div>
                        <h3 class="text-lg font-bold text-white leading-tight">Diversify Supply Chain</h3>
                        <p class="text-xs text-gray-400 leading-relaxed">
                            OmniStock AI detects a 15% increase in lead times from Asian electronics suppliers. We recommend onboarding 2 local alternatives.
                        </p>
                    </div>

                    <div class="pt-4 mt-2">
                        <button onclick="alert('OmniBot AI sedang memproses analisis alternatif supplier...') cursor-pointer" class="w-full py-2 px-4 rounded-xl bg-[#1b2233] hover:bg-[#232c42] border border-gray-700/80 text-gray-200 font-semibold text-xs flex items-center justify-center gap-2 transition-all">
                            <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            Find Alternatives
                        </button>
                    </div>
                </div>

            </div>

        </main>
    </div>

    <!-- Modal Add Supplier -->
    <div id="modalAddSupplier" class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center hidden z-50">
        <div class="bg-[#131722] border border-gray-800 p-6 rounded-2xl w-full max-w-md shadow-2xl space-y-4">
            <h3 class="text-lg font-bold text-white">Add New Supplier</h3>
            <form id="formAddSupplier" class="space-y-3">
                <input type="text" id="supName" placeholder="Supplier Company Name" class="w-full bg-[#0c0e17] border border-gray-800 rounded-xl p-3 text-xs text-white focus:outline-none focus:border-blue-500" required>
                <input type="text" id="supContact" placeholder="Contact Person Name" class="w-full bg-[#0c0e17] border border-gray-800 rounded-xl p-3 text-xs text-white focus:outline-none focus:border-blue-500">
                <input type="text" id="supPhone" placeholder="Phone Number" class="w-full bg-[#0c0e17] border border-gray-800 rounded-xl p-3 text-xs text-white focus:outline-none focus:border-blue-500">
                <input type="text" id="supAddress" placeholder="Location / Address (e.g. Shenzhen, CN)" class="w-full bg-[#0c0e17] border border-gray-800 rounded-xl p-3 text-xs text-white focus:outline-none focus:border-blue-500">
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="document.getElementById('modalAddSupplier').classList.add('hidden')" class="px-4 py-2 bg-gray-800 text-gray-300 text-xs rounded-xl font-semibold">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white text-xs rounded-xl font-bold">Save Supplier</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('formAddSupplier').addEventListener('submit', async (e) => {
            e.preventDefault();
            const res = await fetch('/suppliers', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    name: document.getElementById('supName').value,
                    contact_person: document.getElementById('supContact').value,
                    phone: document.getElementById('supPhone').value,
                    address: document.getElementById('supAddress').value,
                })
            });
            if(res.ok) location.reload();
        });

        async function deleteSupplier(id) {
            if(!confirm('Hapus supplier ini?')) return;
            const res = await fetch('/suppliers/' + id, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
            });
            if(res.ok) location.reload();
        }
    </script>
</body>
</html>