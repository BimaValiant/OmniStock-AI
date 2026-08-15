<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Product;
use App\Models\AiChatLog;

class AiController extends Controller
{
    public function ask(Request $request)
    {
        try {
            $userPrompt = $request->input('prompt');

            if (!$userPrompt) {
                return response()->json(['status' => 'error', 'message' => 'Prompt tidak boleh kosong!'], 400);
            }

            // 1. Ambil data produk dari database
            $products = Product::with('category')->get();
            $context = "Kamu adalah OmniBot, asisten AI analisis inventaris untuk sistem OmniStock AI.\n";
            $context .= "INSTRUKSI PENTING:\n";
            $context .= "1. Jawab pertanyaan pengguna secara natural, profesional, dan ringkas\n";
            $context .= "2. Gunakan format markdown untuk struktur yang lebih baik:\n";
            $context .= "   - Gunakan **text** untuk menekankan hal penting\n";
            $context .= "   - Gunakan bullet points (•) atau angka untuk daftar\n";
            $context .= "   - Gunakan heading dengan ## atau ### untuk bagian\n";
            $context .= "3. DILARANG menampilkan format 'Role:', 'Context:', 'Question:', atau catatan pemikiran internalmu!\n";
            $context .= "4. Berikan rekomendasi konkret jika ditanya tentang stok atau strategi\n\n";
            $context .= "Data Stok Produk Saat Ini:\n";

            foreach ($products as $p) {
                $categoryName = $p->category->name ?? 'Uncategorized';
                $context .= "- Nama: {$p->name} | SKU: {$p->sku} | Kategori: {$categoryName} | Stok: {$p->stock} | Min Alert: {$p->min_stock_alert} | Harga Jual: Rp {$p->selling_price}\n";
            }

            $apiKey = env('GEMINI_API_KEY');

            if (!$apiKey) {
                return response()->json(['status' => 'error', 'message' => 'GEMINI_API_KEY belum terpasang di .env!'], 400);
            }

            // 2. Coba kirim request ke API
            $models = ['gemini-2.5-flash', 'gemini-1.5-flash', 'gemini-2.0-flash-exp'];
            $aiReply = null;
            $errorLog = '';

            foreach ($models as $model) {
                $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";
                
                $response = Http::withoutVerifying()->post($url, [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $context . "\nPertanyaan User: " . $userPrompt]
                            ]
                        ]
                    ]
                ]);

                if ($response->successful()) {
                    $rawText = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? null;
                    if ($rawText) {
                        // Saring teks pemikiran internal / draft jika kebetulan terikut
                        $aiReply = preg_replace('/(Role:|Context\/Data:|Question:|Identification of|Refining for|Drafting the response:).*?(\n\n|\r\n\r\n)/s', '', $rawText);
                        $aiReply = trim($aiReply);
                        break;
                    }
                } else {
                    $errorLog = $response->body();
                }
            }

            // 3. Fallback jika model spesifik di atas tidak merespon
            if (!$aiReply) {
                $listRes = Http::withoutVerifying()->get("https://generativelanguage.googleapis.com/v1beta/models?key={$apiKey}");
                
                if ($listRes->successful()) {
                    $availableModels = $listRes->json()['models'] ?? [];
                    foreach ($availableModels as $m) {
                        if (in_array('generateContent', $m['supportedGenerationMethods'] ?? [])) {
                            $modelName = $m['name'];
                            $url = "https://generativelanguage.googleapis.com/v1beta/{$modelName}:generateContent?key={$apiKey}";
                            
                            $resDynamic = Http::withoutVerifying()->post($url, [
                                'contents' => [['parts' => [['text' => $context . "\nPertanyaan User: " . $userPrompt]]]]
                            ]);

                            if ($resDynamic->successful()) {
                                $rawText = $resDynamic->json()['candidates'][0]['content']['parts'][0]['text'] ?? null;
                                if ($rawText) {
                                    $aiReply = preg_replace('/(Role:|Context\/Data:|Question:|Identification of|Refining for|Drafting the response:).*?(\n\n|\r\n\r\n)/s', '', $rawText);
                                    $aiReply = trim($aiReply);
                                    break;
                                }
                            }
                        }
                    }
                }
            }

            if (!$aiReply) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal mendapatkan respon AI: ' . $errorLog
                ], 400);
            }

            // 4. Simpan log
            try {
                AiChatLog::create([
                    'user_prompt' => $userPrompt,
                    'ai_response' => $aiReply,
                ]);
            } catch (\Exception $e) {}

            return response()->json([
                'status' => 'success',
                'reply' => $aiReply
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Backend Error: ' . $e->getMessage()
            ], 500);
        }
    }
}