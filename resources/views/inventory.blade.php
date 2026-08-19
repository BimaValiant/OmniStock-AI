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
                    <button onclick="openModal('recordSaleModal')" class="w-full flex items-center justify-center gap-2 bg-[#f3f4f6] text-[#111827] font-semibold text-sm rounded-xl py-2.5 shadow-sm hover:bg-gray-100 transition">
                        <span class="text-lg leading-none">+</span> New Transaction
                    </button>
                </div>

                <nav class="space-y-1.5">
                    <a href="{{ url('/') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        <span class="truncate">Dashboard</span>
                    </a>
                    <a href="{{ url('/inventory') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium bg-slate-700/60 text-white font-semibold shadow-sm transition-all duration-200">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        <span class="truncate">Inventory</span>
                    </a>
                    <a href="{{ url('/transactions') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z"></path></svg>
                        <span class="truncate">Transactions</span>
                    </a>
                    <a href="{{ url('/stock-movements') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        <span class="truncate">Stock Movements</span>
                    </a>
                    <a href="{{ url('/purchase-orders') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <span class="truncate">Purchase Orders</span>
                    </a>
                    <a href="{{ url('/suppliers') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <span class="truncate">Suppliers</span>
                    </a>
                    <a href="{{ url('/reports') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        <span class="truncate">Reports</span>
                    </a>
                    <a href="{{ url('/settings') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="truncate">Settings</span>
                    </a>
                </nav>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col bg-slateBg overflow-hidden">
            <!-- HEADER SEARCH -->
            <header class="h-14 border-b border-slateBorder bg-[#0b1220] px-6 flex items-center justify-between flex-shrink-0">
                <div class="relative flex-1 max-w-[360px]">
                    <input type="text" id="inventorySearch" placeholder="Search inventory, SKU, name, or category..." class="w-full bg-[#111622] border border-slateBorder/80 rounded-lg py-2 pl-9 pr-3 text-xs text-slate-200 focus:outline-none focus:border-slate-500 placeholder-slate-500">
                    <span class="absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-500 text-xs">🔍</span>
                </div>
                <div class="flex items-center gap-2.5 ml-4 flex-shrink-0">
                    <button onclick="openModal('addProductModal')" class="bg-[#212938] border border-slate-600/50 hover:bg-slate-700 text-white text-xs font-medium px-3.5 py-1.5 rounded-lg flex items-center gap-1.5 transition whitespace-nowrap">
                        <span>+</span> Add Product
                    </button>
                    <button onclick="openModal('recordSaleModal')" class="px-3.5 py-1.5 bg-[#131722] hover:bg-gray-800 border border-gray-800 rounded-xl text-xs font-semibold text-gray-200 transition-all whitespace-nowrap">
                        Record Sale
                    </button>
                </div>
            </header>

            <!-- PAGE CONTENT -->
            <main class="flex-1 overflow-y-auto p-6 md:p-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="font-headline font-bold text-2xl text-white tracking-tight">Inventory Management</h1>
                        <p class="text-xs text-slate-400 mt-0.5">Manage and track your products across all warehouses.</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ url('/export-csv') }}" class="bg-[#18202F] hover:bg-slate-800 text-slate-300 border border-slateBorder font-semibold text-xs px-3.5 py-1.5 rounded-lg transition">Export CSV</a>
                        <button onclick="openModal('addProductModal')" class="bg-slate-200 hover:bg-white text-slate-900 font-semibold text-xs px-3.5 py-1.5 rounded-lg transition">+ Add Product</button>
                    </div>
                </div>

                <!-- INVENTORY TABLE CONTAINER -->
                <div class="bg-slateCard border border-slateBorder rounded-xl overflow-hidden shadow-xl">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slateBorder bg-[#0f1420] text-[10px] uppercase font-bold text-slate-400 tracking-wider">
                                <th class="p-4">Product</th>
                                <th class="p-4">SKU</th>
                                <th class="p-4">Category</th>
                                <th class="p-4">Stock Level</th>
                                <th class="p-4">Unit Price</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="inventoryTableBody" class="divide-y divide-slateBorder/60 text-xs">
                            @forelse($products as $p)
                                <tr class="hover:bg-slate-800/30 transition">
                                    <td class="p-4 font-medium text-white">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-lg bg-slate-800 border border-slate-700 flex items-center justify-center font-bold text-slate-300 text-[10px]">
                                                {{ strtoupper(substr($p->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div>{{ $p->name }}</div>
                                                <div class="text-[10px] text-slate-500">{{ $p->category->name ?? 'General' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 font-mono text-slate-400">{{ $p->sku }}</td>
                                    <td class="p-4">
                                        <span class="bg-slate-800 border border-slate-700 text-slate-300 text-[10px] px-2 py-0.5 rounded">
                                            {{ $p->category->name ?? 'General' }}
                                        </span>
                                    </td>
                                    <td class="p-4 font-semibold text-white">
                                        {{ $p->stock }}
                                        <span class="text-[10px] text-slate-500 font-normal">/ min {{ $p->min_stock_alert }}</span>
                                    </td>
                                    <td class="p-4 text-slate-200">Rp {{ number_format($p->selling_price, 0, ',', '.') }}</td>
                                    <td class="p-4">
                                        @if($p->stock == 0)
                                            <span class="bg-red-950/80 text-red-400 border border-red-800/50 text-[10px] font-bold px-2 py-0.5 rounded">Out of Stock</span>
                                        @elseif($p->stock <= $p->min_stock_alert)
                                            <span class="bg-amber-950/80 text-amber-400 border border-amber-800/50 text-[10px] font-bold px-2 py-0.5 rounded">Low Stock</span>
                                        @else
                                            <span class="bg-emerald-950/80 text-emerald-400 border border-emerald-800/50 text-[10px] font-bold px-2 py-0.5 rounded">In Stock</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-right space-x-2">
                                        <button onclick="editProduct({{ json_encode($p) }})" class="text-indigo-400 hover:text-indigo-300 text-xs font-semibold">Edit</button>
                                        <button onclick="deleteProduct({{ $p->id }})" class="text-rose-400 hover:text-rose-300 text-xs font-semibold">Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-8 text-center text-slate-500">No products found in inventory.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- MODAL 1: ADD PRODUCT -->
    <div id="addProductModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-slateCard border border-slateBorder rounded-2xl w-full max-w-md p-6 shadow-2xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-headline font-bold text-white text-sm">Add New Product</h3>
                <button onclick="closeModal('addProductModal')" class="text-slate-400 hover:text-white">✕</button>
            </div>
            <form id="addProductForm" onsubmit="submitAddProduct(event)" class="space-y-3 text-xs">
                <div>
                    <label class="block text-slate-400 mb-1">Product Name *</label>
                    <input type="text" name="name" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white focus:outline-none focus:border-blue-500">
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-slate-400 mb-1">SKU *</label>
                        <input type="text" name="sku" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white focus:outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-slate-400 mb-1">Category</label>
                        <select name="category_id" class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white focus:outline-none focus:border-blue-500">
                            <option value="">General</option>
                            @foreach($categories ?? [] as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-slate-400 mb-1">Stock Quantity *</label>
                        <input type="number" name="stock" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white focus:outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-slate-400 mb-1">Min Stock Alert *</label>
                        <input type="number" name="min_stock_alert" value="10" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white focus:outline-none focus:border-blue-500">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div class="grid grid-cols-2 gap-2">
    <div>
        <label class="block text-slate-400 mb-1">Cost Price / Modal (Rp)</label>
        <input type="number" id="edit_cost_price" name="cost_price" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white">
    </div>
    <div>
        <label class="block text-slate-400 mb-1">Selling Price (Rp)</label>
        <input type="number" id="edit_selling_price" name="selling_price" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white">
    </div>
</div>
                <div class="pt-2 flex justify-end gap-2">
                    <button type="button" onclick="closeModal('addProductModal')" class="px-3 py-1.5 bg-slate-800 text-slate-300 rounded-lg">Cancel</button>
                    <button type="submit" class="px-4 py-1.5 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-lg">Save Product</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL 2: EDIT PRODUCT -->
    <div id="editProductModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-slateCard border border-slateBorder rounded-2xl w-full max-w-md p-6 shadow-2xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-headline font-bold text-white text-sm">Edit Product</h3>
                <button onclick="closeModal('editProductModal')" class="text-slate-400 hover:text-white">✕</button>
            </div>
            <form id="editProductForm" onsubmit="submitEditProduct(event)" class="space-y-3 text-xs">
                <input type="hidden" id="edit_product_id">
                <div>
                    <label class="block text-slate-400 mb-1">Product Name</label>
                    <input type="text" id="edit_name" name="name" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white">
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-slate-400 mb-1">SKU</label>
                        <input type="text" id="edit_sku" name="sku" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white">
                    </div>
                    <div>
                        <label class="block text-slate-400 mb-1">Category</label>
                        <select id="edit_category_id" name="category_id" class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white">
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
                        <input type="number" id="edit_stock" name="stock" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white">
                    </div>
                    <div>
                        <label class="block text-slate-400 mb-1">Min Stock Alert</label>
                        <input type="number" id="edit_min_stock_alert" name="min_stock_alert" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white">
                    </div>
                </div>
                <div>
                    <label class="block text-slate-400 mb-1">Selling Price (Rp)</label>
                    <input type="number" id="edit_selling_price" name="selling_price" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2 text-white">
                </div>
                <div class="pt-2 flex justify-end gap-2">
                    <button type="button" onclick="closeModal('editProductModal')" class="px-3 py-1.5 bg-slate-800 text-slate-300 rounded-lg">Cancel</button>
                    <button type="submit" class="px-4 py-1.5 bg-blue-600 hover:bg-blue-500 text-white font-semibold rounded-lg">Update Product</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL 3: RECORD SALE -->
    <div id="recordSaleModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-slateCard border border-slateBorder rounded-2xl w-full max-w-md p-6 shadow-2xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-headline font-bold text-white text-sm">Record Sale Transaction</h3>
                <button onclick="closeModal('recordSaleModal')" class="text-slate-400 hover:text-white">✕</button>
            </div>
            <form id="recordSaleForm" onsubmit="submitRecordSale(event)" class="space-y-4 text-xs">
                <div>
                    <label class="block text-slate-400 mb-1">Select Product *</label>
                    <select name="product_id" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2.5 text-white">
                        <option value="">-- Choose Product --</option>
                        @foreach($products as $prod)
                            <option value="{{ $prod->id }}">{{ $prod->name }} (Stock: {{ $prod->stock }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-slate-400 mb-1">Quantity Sold *</label>
                    <input type="number" name="qty" min="1" value="1" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2.5 text-white">
                </div>
                <div class="pt-2 flex justify-end gap-2">
                    <button type="button" onclick="closeModal('recordSaleModal')" class="px-3 py-1.5 bg-slate-800 text-slate-300 rounded-lg">Cancel</button>
                    <button type="submit" class="px-4 py-1.5 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold rounded-lg">Complete Sale</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JAVASCRIPT LOGIC -->
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function openModal(modalId) { document.getElementById(modalId).classList.remove('hidden'); }
        function closeModal(modalId) { document.getElementById(modalId).classList.add('hidden'); }

        // Live Search Filter Table
        document.getElementById('inventorySearch').addEventListener('input', function(e) {
            const query = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('#inventoryTableBody tr');
            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });

        // Submit Add Product via AJAX
        function submitAddProduct(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            fetch('/products/store', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    window.location.reload();
                }
            });
        }

        // Populate Edit Modal
        function editProduct(product) {
            document.getElementById('edit_product_id').value = product.id;
            document.getElementById('edit_name').value = product.name;
            document.getElementById('edit_sku').value = product.sku;
            document.getElementById('edit_category_id').value = product.category_id || '';
            document.getElementById('edit_stock').value = product.stock;
            document.getElementById('edit_min_stock_alert').value = product.min_stock_alert;
            document.getElementById('edit_cost_price').value = product.cost_price || 0; // <-- Penambahan baris ini
            document.getElementById('edit_selling_price').value = product.selling_price;
            openModal('editProductModal');
        }

        // Submit Edit Product
        function submitEditProduct(e) {
            e.preventDefault();
            const id = document.getElementById('edit_product_id').value;
            const formData = new FormData(e.target);
            fetch(`/products/${id}`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    window.location.reload();
                }
            });
        }

        // Delete Product
        function deleteProduct(id) {
            if (!confirm('Hapus produk ini dari inventory?')) return;
            fetch(`/products/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    window.location.reload();
                }
            });
        }

        // Submit Record Sale
        function submitRecordSale(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            fetch('/record-sale', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    window.location.reload();
                } else {
                    alert(data.message);
                }
            });
        }
    </script>
</body>
</html>