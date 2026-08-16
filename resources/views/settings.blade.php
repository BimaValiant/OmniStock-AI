<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>OmniStock AI - Settings</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#0d1322] border-r border-gray-800/80 min-h-screen p-5 flex flex-col justify-between select-none shrink-0">
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
                <a href="{{ url('/reports') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:bg-gray-800/50 hover:text-gray-200 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Reports
                </a>
                <a href="{{ url('/settings') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 bg-slate-700/60 text-white font-semibold shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Settings
                </a>
            </nav>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-6 md:p-8 overflow-y-auto">
        <div class="mb-6">
            <h1 class="font-headline font-bold text-2xl text-white tracking-tight">Settings</h1>
            <p class="text-xs text-slate-400 mt-0.5">Manage your organization preferences and AI configuration.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- SIDE NAVIGATION TABS -->
            <div class="bg-slateCard border border-slateBorder rounded-xl p-2.5 h-fit shadow-lg shadow-black/20">
                <nav class="space-y-1">
                    <button onclick="switchTab('general')" id="tab-general" class="w-full text-left px-4 py-2.5 rounded-lg text-xs font-semibold transition bg-blue-600 text-white shadow-md shadow-blue-600/20">General</button>
                    <button onclick="switchTab('profile')" id="tab-profile" class="w-full text-left px-4 py-2.5 rounded-lg text-xs font-medium text-slate-400 hover:bg-slate-800/60 hover:text-white transition">Profile</button>
                    <button onclick="switchTab('notifications')" id="tab-notifications" class="w-full text-left px-4 py-2.5 rounded-lg text-xs font-medium text-slate-400 hover:bg-slate-800/60 hover:text-white transition">Notifications</button>
                </nav>
            </div>

            <!-- FORM CONTENT AREA -->
            <div class="lg:col-span-3">
                
                <!-- GENERAL TAB -->
                <div id="content-general" class="space-y-6">
                    <form onsubmit="saveGeneral(event)" class="bg-slateCard border border-slateBorder rounded-xl p-6 space-y-6 shadow-lg shadow-black/20">
                        <div>
                            <h3 class="font-headline font-bold text-white text-sm mb-4 tracking-wide uppercase text-slate-400 text-[11px]">Organization Profile</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-xs font-medium text-slate-300 mb-2">Organization Name</label>
                                    <input type="text" id="org_name" value="{{ session('org_name', 'Acme Global Logistics') }}" class="w-full bg-[#0d1322] border border-slateBorder rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-blue-500 transition" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-300 mb-2">Primary Currency</label>
                                    <select id="currency" class="w-full bg-[#0d1322] border border-slateBorder rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-blue-500 transition">
                                        <option value="IDR" {{ session('currency', 'IDR') == 'IDR' ? 'selected' : '' }}>IDR (Rupiah)</option>
                                        <option value="USD" {{ session('currency') == 'USD' ? 'selected' : '' }}>USD ($)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="border-slateBorder/60">

                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-headline font-bold text-white text-sm tracking-wide uppercase text-slate-400 text-[11px]">AI Forecasting Engine</h3>
                                <span id="intensityBadge" class="bg-blue-600/20 text-blue-400 border border-blue-500/30 text-[11px] px-2.5 py-0.5 rounded-full font-bold">Balanced</span>
                            </div>
                            <p class="text-xs text-slate-400 mb-4">Adjust the algorithm sensitivity for stock replenishment recommendations.</p>
                            
                            <input type="range" id="forecastingSlider" min="1" max="3" value="{{ session('forecasting_intensity', '2') }}" oninput="updateSliderLabel(this.value)" class="w-full h-2 bg-slate-800 rounded-lg appearance-none cursor-pointer accent-blue-600">
                            
                            <div class="p-3.5 bg-[#0d1322] border border-slateBorder/80 rounded-xl mt-4 text-xs text-slate-400">
                                <span id="forecastingDesc">The AI currently attempts to balance holding costs with a 95% service level target based on historical sales data.</span>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-2">
                            <button type="button" onclick="location.reload()" class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-800 hover:bg-slate-700 text-white transition">Cancel</button>
                            <button type="submit" class="px-5 py-2 rounded-xl text-xs font-semibold bg-blue-600 hover:bg-blue-500 text-white shadow-md shadow-blue-600/30 transition">Save Changes</button>
                        </div>
                    </form>
                </div>

                <!-- PROFILE TAB -->
                <div id="content-profile" class="hidden space-y-6">
                    <form onsubmit="saveProfile(event)" class="bg-slateCard border border-slateBorder rounded-xl p-6 space-y-4 shadow-lg shadow-black/20">
                        <h3 class="font-headline font-bold text-white text-sm mb-2 tracking-wide uppercase text-slate-400 text-[11px]">User Account Profile</h3>
                        <div>
                            <label class="block text-xs font-medium text-slate-300 mb-2">Full Name</label>
                            <input type="text" id="user_name" value="{{ Auth::user()->name ?? 'Bima Valiant' }}" class="w-full bg-[#0d1322] border border-slateBorder rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-blue-500 transition" required>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-300 mb-2">Email Address</label>
                            <input type="email" id="user_email" value="{{ Auth::user()->email ?? 'bima@omnistock.com' }}" class="w-full bg-[#0d1322] border border-slateBorder rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-blue-500 transition" required>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-300 mb-2">New Password (Optional)</label>
                            <input type="password" id="user_password" placeholder="Leave blank to keep current" class="w-full bg-[#0d1322] border border-slateBorder rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-blue-500 transition">
                        </div>
                        <div class="flex justify-end pt-4">
                            <button type="submit" class="px-5 py-2 rounded-xl text-xs font-semibold bg-blue-600 hover:bg-blue-500 text-white shadow-md shadow-blue-600/30 transition">Update Profile</button>
                        </div>
                    </form>
                </div>

                <!-- NOTIFICATIONS TAB -->
                <div id="content-notifications" class="hidden space-y-6">
                    <div class="bg-slateCard border border-slateBorder rounded-xl p-6 space-y-4 shadow-lg shadow-black/20">
                        <h3 class="font-headline font-bold text-white text-sm mb-2 tracking-wide uppercase text-slate-400 text-[11px]">Notification Preferences</h3>
                        <div class="flex items-center justify-between py-3 border-b border-slateBorder/60">
                            <div>
                                <p class="text-xs font-semibold text-white">Low Stock Email Alert</p>
                                <p class="text-[11px] text-slate-400">Receive an immediate notification when stock reaches critical limit.</p>
                            </div>
                            <input type="checkbox" checked class="w-4 h-4 accent-blue-600 rounded cursor-pointer">
                        </div>
                        <div class="flex items-center justify-between py-3">
                            <div>
                                <p class="text-xs font-semibold text-white">Weekly Analytics Summary</p>
                                <p class="text-[11px] text-slate-400">Get weekly digest reports on inventory performance.</p>
                            </div>
                            <input type="checkbox" checked class="w-4 h-4 accent-blue-600 rounded cursor-pointer">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            updateSliderLabel(document.getElementById('forecastingSlider').value);
        });

        function switchTab(tabName) {
            ['general', 'profile', 'notifications'].forEach(tab => {
                document.getElementById('content-' + tab).classList.add('hidden');
                let btn = document.getElementById('tab-' + tab);
                btn.className = "w-full text-left px-4 py-2.5 rounded-lg text-xs font-medium text-slate-400 hover:bg-slate-800/60 hover:text-white transition";
            });

            document.getElementById('content-' + tabName).classList.remove('hidden');
            let activeBtn = document.getElementById('tab-' + tabName);
            activeBtn.className = "w-full text-left px-4 py-2.5 rounded-lg text-xs font-semibold transition bg-blue-600 text-white shadow-md shadow-blue-600/20";
        }

        function updateSliderLabel(val) {
            const badge = document.getElementById('intensityBadge');
            const desc = document.getElementById('forecastingDesc');
            if(val == 1) {
                badge.innerText = 'Conservative';
                desc.innerText = 'Low holding cost focus with moderate safety stock buffer.';
            } else if(val == 2) {
                badge.innerText = 'Balanced';
                desc.innerText = 'The AI currently attempts to balance holding costs with a 95% service level target based on historical sales data.';
            } else {
                badge.innerText = 'Aggressive';
                desc.innerText = 'Maximum stock availability target (99% service level) to eliminate stockouts.';
            }
        }

        // AJAX Kirim Data General
        function saveGeneral(e) {
            e.preventDefault();
            const payload = {
                org_name: document.getElementById('org_name').value,
                currency: document.getElementById('currency').value,
                forecasting_intensity: document.getElementById('forecastingSlider').value,
            };

            fetch("{{ route('settings.general') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Tersimpan!',
                        text: data.message,
                        background: '#131927',
                        color: '#fff',
                        confirmButtonColor: '#2563eb'
                    });
                }
            })
            .catch(() => {
                Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal menyimpan pengaturan.', background: '#131927', color: '#fff' });
            });
        }

        // AJAX Kirim Data Profile
        function saveProfile(e) {
            e.preventDefault();
            const payload = {
                name: document.getElementById('user_name').value,
                email: document.getElementById('user_email').value,
                password: document.getElementById('user_password').value,
            };

            fetch("{{ route('settings.profile') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Profil Diperbarui!',
                        text: data.message,
                        background: '#131927',
                        color: '#fff',
                        confirmButtonColor: '#2563eb'
                    });
                }
            })
            .catch(() => {
                Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal memperbarui profil.', background: '#131927', color: '#fff' });
            });
        }
    </script>
</body>
</html>