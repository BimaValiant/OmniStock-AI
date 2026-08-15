<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>OmniStock AI - Purchase Orders</title>

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
                <a href="{{ url('/purchase-orders') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 bg-slate-700/60 text-white font-semibold shadow-sm">
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
                <a href="{{ url('/reports') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
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
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="font-headline font-bold text-2xl text-white tracking-tight">Purchase Orders</h1>
                <p class="text-xs text-slate-400 mt-0.5">Manage supplier orders and track deliveries</p>
            </div>
            <button onclick="openPOForm()" class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                + Create PO
            </button>
        </div>

        <div class="grid grid-cols-4 gap-4 mb-6">
            <div class="bg-slateCard border border-slateBorder rounded-xl p-4">
                <p class="text-[10px] text-slate-400 uppercase mb-1">Total POs</p>
                <h2 class="text-2xl font-bold text-white">{{ count($purchaseOrders) }}</h2>
            </div>
            <div class="bg-slateCard border border-slateBorder rounded-xl p-4">
                <p class="text-[10px] text-slate-400 uppercase mb-1">Pending</p>
                <h2 class="text-2xl font-bold text-amber-400">{{ count($purchaseOrders->where('status', 'pending')) }}</h2>
            </div>
            <div class="bg-slateCard border border-slateBorder rounded-xl p-4">
                <p class="text-[10px] text-slate-400 uppercase mb-1">Received</p>
                <h2 class="text-2xl font-bold text-emerald-400">{{ count($purchaseOrders->where('status', 'received')) }}</h2>
            </div>
            <div class="bg-slateCard border border-slateBorder rounded-xl p-4">
                <p class="text-[10px] text-slate-400 uppercase mb-1">Total Value</p>
                <h2 class="text-lg font-bold text-white">Rp {{ number_format($purchaseOrders->sum('total_amount'), 0, ',', '.') }}</h2>
            </div>
        </div>

        <div class="bg-slateCard border border-slateBorder rounded-xl p-5 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-300">
                    <thead class="text-[10px] text-slate-400 uppercase bg-[#0B0F19]/60 border-b border-slateBorder">
                        <tr>
                            <th class="py-3 px-4">PO CODE</th>
                            <th class="py-3 px-4">SUPPLIER</th>
                            <th class="py-3 px-4">STATUS</th>
                            <th class="py-3 px-4">ITEMS</th>
                            <th class="py-3 px-4">TOTAL</th>
                            <th class="py-3 px-4">ORDER DATE</th>
                            <th class="py-3 px-4">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slateBorder/40">
                        @forelse($purchaseOrders as $po)
                            <tr class="hover:bg-slate-800/20">
                                <td class="py-3 px-4 font-bold text-blue-400">{{ $po->po_code }}</td>
                                <td class="py-3 px-4 text-white">{{ $po->supplier->name }}</td>
                                <td class="py-3 px-4">
                                    <span class="inline-block px-2 py-1 rounded text-xs font-semibold {{ $po->getStatusColor() }} text-white">
                                        {{ $po->getStatusLabel() }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">{{ count($po->items) }}</td>
                                <td class="py-3 px-4 font-semibold text-emerald-400">Rp {{ number_format($po->total_amount, 0, ',', '.') }}</td>
                                <td class="py-3 px-4">{{ $po->order_date->format('d M Y') }}</td>
                                <td class="py-3 px-4">
                                    <div class="flex gap-2">
                                        <a href="{{ route('purchase-orders.show', $po->id) }}" class="text-blue-400 hover:text-blue-300">View</a>
                                        @if($po->status !== 'received')
                                            <button onclick="updatePOStatus({{ $po->id }}, 'received')" class="text-emerald-400 hover:text-emerald-300 text-xs">Mark Received</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-10 text-center text-slate-400">No purchase orders created yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
            {{ $purchaseOrders->links() }}
        </div>
    </main>

    <!-- Modal for Creating PO -->
    <div id="poModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 hidden flex items-center justify-center overflow-y-auto">
        <div class="bg-slateCard border border-slateBorder rounded-2xl w-full max-w-2xl p-6 shadow-2xl my-8">
            <h2 class="font-headline font-bold text-white text-lg mb-4">Create Purchase Order</h2>
            <form id="poForm" class="space-y-4 text-sm max-h-[70vh] overflow-y-auto">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-slate-400 mb-1.5">Supplier *</label>
                        <select name="supplier_id" required class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2.5 text-white focus:outline-none focus:border-indigo-500">
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-slate-400 mb-1.5">Order Date *</label>
                        <input type="date" name="order_date" required value="{{ date('Y-m-d') }}" class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2.5 text-white focus:outline-none focus:border-indigo-500">
                    </div>
                </div>

                <div>
                    <label class="block text-slate-400 mb-1.5">Expected Delivery</label>
                    <input type="date" name="expected_delivery" class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2.5 text-white focus:outline-none focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-slate-400 mb-2">Order Items</label>
                    <div id="itemsContainer" class="space-y-3">
                        <div class="item-row grid grid-cols-4 gap-2 bg-[#0B0F19] p-3 rounded-lg border border-slateBorder">
                            <div>
                                <select name="items[0][product_id]" required class="w-full bg-slate-900 border border-slateBorder rounded p-2 text-white text-xs focus:outline-none">
                                    <option value="">Product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <input type="number" name="items[0][quantity]" required min="1" placeholder="Qty" class="w-full bg-slate-900 border border-slateBorder rounded p-2 text-white text-xs focus:outline-none">
                            </div>
                            <div>
                                <input type="number" name="items[0][unit_price]" required min="0" step="0.01" placeholder="Price" class="w-full bg-slate-900 border border-slateBorder rounded p-2 text-white text-xs focus:outline-none">
                            </div>
                            <button type="button" onclick="removeItem(this)" class="bg-red-600 hover:bg-red-500 text-white rounded px-2 py-1 text-xs">Remove</button>
                        </div>
                    </div>
                    <button type="button" onclick="addItem()" class="mt-2 text-indigo-400 hover:text-indigo-300 text-xs font-semibold">+ Add Item</button>
                </div>

                <div>
                    <label class="block text-slate-400 mb-1.5">Notes</label>
                    <textarea name="notes" rows="2" class="w-full bg-[#0B0F19] border border-slateBorder rounded-lg p-2.5 text-white focus:outline-none focus:border-indigo-500 resize-none"></textarea>
                </div>

                <div class="flex gap-2 mt-6">
                    <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-500 text-white py-2.5 rounded-lg font-semibold transition">
                        Create Order
                    </button>
                    <button type="button" onclick="closePOForm()" class="flex-1 bg-slate-700 hover:bg-slate-600 text-white py-2.5 rounded-lg font-semibold transition">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let itemCount = 1;

        function openPOForm() {
            document.getElementById('poModal').classList.remove('hidden');
        }

        function closePOForm() {
            document.getElementById('poModal').classList.add('hidden');
        }

        function addItem() {
            const container = document.getElementById('itemsContainer');
            const newRow = `
                <div class="item-row grid grid-cols-4 gap-2 bg-[#0B0F19] p-3 rounded-lg border border-slateBorder">
                    <div>
                        <select name="items[${itemCount}][product_id]" required class="w-full bg-slate-900 border border-slateBorder rounded p-2 text-white text-xs focus:outline-none">
                            <option value="">Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <input type="number" name="items[${itemCount}][quantity]" required min="1" placeholder="Qty" class="w-full bg-slate-900 border border-slateBorder rounded p-2 text-white text-xs focus:outline-none">
                    </div>
                    <div>
                        <input type="number" name="items[${itemCount}][unit_price]" required min="0" step="0.01" placeholder="Price" class="w-full bg-slate-900 border border-slateBorder rounded p-2 text-white text-xs focus:outline-none">
                    </div>
                    <button type="button" onclick="removeItem(this)" class="bg-red-600 hover:bg-red-500 text-white rounded px-2 py-1 text-xs">Remove</button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newRow);
            itemCount++;
        }

        function removeItem(btn) {
            btn.closest('.item-row').remove();
        }

        document.getElementById('poForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData);
            data.items = [];

            // Reconstruct items array properly
            document.querySelectorAll('.item-row').forEach((row, idx) => {
                const row_data = {};
                row.querySelectorAll('input, select').forEach(field => {
                    if (field.name) {
                        const match = field.name.match(/items\[\d+\]\[(\w+)\]/);
                        if (match) {
                            row_data[match[1]] = field.value;
                        }
                    }
                });
                if (Object.keys(row_data).length > 0) {
                    data.items.push(row_data);
                }
            });

            try {
                const response = await fetch("{{ route('purchase-orders.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();
                if (result.status === 'success') {
                    alert('Purchase Order ' + result.po_code + ' created successfully!');
                    location.reload();
                } else {
                    alert('Error: ' + (result.message || 'Unknown error'));
                }
            } catch (error) {
                alert('Error saving PO: ' + error.message);
            }
        });

        function updatePOStatus(poId, newStatus) {
            if (!confirm('Mark this PO as ' + newStatus + '?')) return;

            fetch("{{ url('/purchase-orders') }}/" + poId + "/status", {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(r => r.json())
            .then(result => {
                if (result.status === 'success') {
                    alert('PO status updated!');
                    location.reload();
                } else {
                    alert('Error: ' + result.message);
                }
            });
        }
    </script>
</body>
</html>
