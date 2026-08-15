<aside class="w-64 bg-[#0E131F] border-r border-[#1E2638] flex flex-col justify-between min-h-screen p-4">
    <div class="space-y-6">
        <!-- Logo -->
        <div class="flex items-center gap-3 px-2">
            <div class="p-2 bg-slate-800/80 text-slate-300 rounded-xl border border-slate-700/60">
                <i data-lucide="cpu" class="w-5 h-5 text-slate-200"></i>
            </div>
            <div>
                <h1 class="font-extrabold text-white text-lg tracking-wide">OmniStock <span class="text-slate-400">AI</span></h1>
                <p class="text-[10px] text-slate-500 font-semibold tracking-wider uppercase">Enterprise Command</p>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="space-y-1">
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-white bg-slate-800/80 border border-slate-700/60 rounded-xl shadow-sm">
                <i data-lucide="layout-dashboard" class="w-4 h-4 text-slate-200"></i>
                Dashboard
            </a>
            <a href="{{ url('/inventory') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-400 hover:text-slate-200 hover:bg-slate-800/40 rounded-xl transition">
                <i data-lucide="package" class="w-4 h-4"></i>
                Inventory
            </a>
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-400 hover:text-slate-200 hover:bg-slate-800/40 rounded-xl transition">
                <i data-lucide="arrow-left-right" class="w-4 h-4"></i>
                Transactions
            </a>
            <a href="{{ url('/suppliers') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-400 hover:text-slate-200 hover:bg-slate-800/40 rounded-xl transition">
                <i data-lucide="truck" class="w-4 h-4"></i>
                Suppliers
            </a>
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-400 hover:text-slate-200 hover:bg-slate-800/40 rounded-xl transition">
                <i data-lucide="bar-chart-3" class="w-4 h-4"></i>
                Reports
            </a>
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-400 hover:text-slate-200 hover:bg-slate-800/40 rounded-xl transition">
                <i data-lucide="settings" class="w-4 h-4"></i>
                Settings
            </a>
        </nav>
    </div>

    <!-- User Profile Footer -->
    <div class="pt-4 border-t border-[#1E2638] flex items-center justify-between px-2">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-slate-800 border border-slate-700/80 flex items-center justify-center font-bold text-xs text-slate-200">
                BV
            </div>
            <div class="text-xs">
                <p class="font-semibold text-slate-200">Bima Valiant</p>
                <p class="text-slate-500">Store Owner</p>
            </div>
        </div>
        <button class="text-slate-500 hover:text-slate-300">
            <i data-lucide="log-out" class="w-4 h-4"></i>
        </button>
    </div>
</aside>