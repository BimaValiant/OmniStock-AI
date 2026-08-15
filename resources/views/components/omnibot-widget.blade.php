<div class="p-6 bg-[#131927] border border-[#1E2638] rounded-2xl space-y-4 flex flex-col justify-between h-[360px]">
    <!-- Header Widget -->
    <div class="flex items-center justify-between border-b border-[#1E2638] pb-3">
        <div class="flex items-center gap-2.5">
            <div class="p-2 bg-slate-800 text-slate-200 rounded-xl border border-slate-700/60">
                <i data-lucide="sparkles" class="w-4 h-4 text-amber-400"></i>
            </div>
            <div>
                <h4 class="font-bold text-white text-sm">OmniBot AI Insight</h4>
                <p class="text-[10px] text-slate-400">Smart Inventory Assistant</p>
            </div>
        </div>
        <span class="text-[10px] bg-slate-800 text-slate-300 px-2.5 py-1 rounded-full border border-slate-700/60 font-semibold">Gemini 1.5 Flash</span>
    </div>

    <!-- Area Chat Output -->
    <div id="chatContainer" class="flex-1 overflow-y-auto space-y-3 pr-1 text-xs text-slate-300">
        <div class="bg-slate-800/50 p-3 rounded-xl border border-slate-700/40">
            <p class="font-semibold text-amber-400 mb-1">🤖 OmniBot:</p>
            <p>Halo! Saya siap menganalisis stok barang kamu. Coba tanyakan: <i>"Barang apa yang stoknya mau habis?"</i></p>
        </div>
    </div>

    <!-- Form Input Chat -->
    <form id="aiForm" class="flex items-center gap-2 pt-2 border-t border-[#1E2638]">
        @csrf
        <input type="text" id="userPrompt" placeholder="Tanyakan stok ke OmniBot..." required
            class="flex-1 bg-slate-900 border border-slate-800 text-white text-xs rounded-xl px-3 py-2.5 focus:outline-none focus:border-slate-600 placeholder-slate-500">
        <button type="submit" id="sendBtn" class="px-3.5 py-2.5 bg-slate-800 hover:bg-slate-700 text-white rounded-xl border border-slate-700/80 font-medium transition flex items-center justify-center">
            <i data-lucide="send" class="w-3.5 h-3.5"></i>
        </button>
    </form>
</div>

<!-- Script AJAX Chatbot -->
<script>
    function formatAiResponse(text) {
        let html = text;
        
        // Format headers (starting with #)
        html = html.replace(/^### (.*?)$/gm, '<p class="font-bold text-slate-200 mt-2">$1</p>');
        html = html.replace(/^## (.*?)$/gm, '<p class="font-bold text-slate-100 text-base mt-3">$1</p>');
        html = html.replace(/^# (.*?)$/gm, '<p class="font-bold text-white text-lg mt-4">$1</p>');
        
        // Format bold text
        html = html.replace(/\*\*(.*?)\*\*/g, '<span class="font-semibold text-slate-100">$1</span>');
        
        // Format italic text
        html = html.replace(/\*(.*?)\*/g, '<em class="text-slate-300">$1</em>');
        
        // Format numbered lists
        html = html.replace(/^\d+\.\s+(.*?)$/gm, '<div class="ml-3 my-1"><span class="text-amber-400 font-semibold">•</span> $1</div>');
        
        // Format bullet points
        html = html.replace(/^[-*]\s+(.*?)$/gm, '<div class="ml-3 my-1"><span class="text-amber-400 font-semibold">•</span> $1</div>');
        
        // Format code blocks (single backticks)
        html = html.replace(/`(.*?)`/g, '<code class="bg-slate-900 px-1.5 py-0.5 rounded text-amber-300 font-mono text-xs">$1</code>');
        
        // Replace line breaks
        html = html.replace(/\n/g, '<br>');
        
        // Remove extra <br> tags
        html = html.replace(/<br><br>/g, '<br>');
        
        return html;
    }

    document.getElementById('aiForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const promptInput = document.getElementById('userPrompt');
        const chatContainer = document.getElementById('chatContainer');
        const sendBtn = document.getElementById('sendBtn');
        const promptText = promptInput.value;

        if(!promptText.trim()) return;

        // Render Chat User
        chatContainer.innerHTML += `
            <div class="bg-slate-800/90 p-3 rounded-xl border border-slate-700/80 text-right">
                <p class="font-semibold text-slate-400 mb-1">Kamu:</p>
                <p class="text-white">${promptText}</p>
            </div>
        `;
        
        promptInput.value = '';
        chatContainer.scrollTop = chatContainer.scrollHeight;

        // Indicator Loading
        const loadingId = 'loading-' + Date.now();
        chatContainer.innerHTML += `
            <div id="${loadingId}" class="bg-slate-800/40 p-3 rounded-xl border border-slate-700/30">
                <p class="font-semibold text-amber-400 mb-1">🤖 OmniBot:</p>
                <p class="animate-pulse text-slate-400">Sedang menganalisis database stok...</p>
            </div>
        `;
        chatContainer.scrollTop = chatContainer.scrollHeight;

        try {
            const response = await fetch("{{ route('ai.ask') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ prompt: promptText })
            });

            const data = await response.json();
            document.getElementById(loadingId).remove();

            if(data.status === 'success') {
                const formattedReply = formatAiResponse(data.reply);
                chatContainer.innerHTML += `
                    <div class="bg-slate-800/50 p-4 rounded-xl border border-slate-700/40">
                        <p class="font-semibold text-amber-400 mb-2">🤖 OmniBot:</p>
                        <div class="text-slate-300 text-sm space-y-2 leading-relaxed">${formattedReply}</div>
                    </div>
                `;
            } else {
                chatContainer.innerHTML += `
                    <div class="bg-rose-950/40 p-3 rounded-xl border border-rose-800/50 text-rose-300">
                        <p class="font-semibold mb-1">⚠️ Error:</p>
                        <p>${data.message}</p>
                    </div>
                `;
            }
        } catch (err) {
            document.getElementById(loadingId).remove();
            chatContainer.innerHTML += `
                <div class="bg-rose-950/40 p-3 rounded-xl border border-rose-800/50 text-rose-300">
                    <p class="font-semibold mb-1">⚠️ Error:</p>
                    <p>Gagal menghubungi server backend.</p>
                </div>
            `;
        }

        chatContainer.scrollTop = chatContainer.scrollHeight;
    });
</script>