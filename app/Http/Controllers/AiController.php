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

            // 1. Definisikan System Instruction (Peran AI yang terisolasi)
            $systemInstructionText = "Kamu adalah OmniBot, asisten AI analisis inventaris untuk sistem OmniStock AI.\n"
                . "INSTRUKSI PENTING:\n"
                . "1. Jawab pertanyaan pengguna secara natural, profesional, ramah, dan ringkas.\n"
                . "2. Gunakan format markdown standar (seperti **bold**, list dengan • atau angka, dan heading ##/###).\n"
                . "3. JANGAN PERNAH menampilkan teks instruksi internal, catatan pemikiran, atau format 'Role:', 'Context:', 'Question:'. Langsung berikan isi jawabannya.\n"
                . "4. Berikan rekomendasi konkret jika ditanya tentang stok atau strategi.";

            // 2. Ambil data produk dari database untuk konteks data
            $products = Product::with('category')->get();
            $dataContext = "Data Stok Produk Saat Ini:\n";

            foreach ($products as $p) {
                $categoryName = $p->category->name ?? 'Uncategorized';
                $dataContext .= "- Nama: {$p->name} | SKU: {$p->sku} | Kategori: {$categoryName} | Stok: {$p->stock} | Min Alert: {$p->min_stock_alert} | Harga Jual: Rp {$p->selling_price}\n";
            }

            $apiKey = env('GEMINI_API_KEY');

            if (!$apiKey) {
                return response()->json(['status' => 'error', 'message' => 'GEMINI_API_KEY belum terpasang di .env!'], 400);
            }

            // Payload body standar Gemini API v1beta dengan system_instruction
            $payload = [
                'system_instruction' => [
                    'parts' => [
                        ['text' => $systemInstructionText]
                    ]
                ],
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $dataContext . "\nPertanyaan User: " . $userPrompt]
                        ]
                    ]
                ]
            ];

            // 3. Coba kirim request ke API berdasarkan model yang tersedia
            $models = ['gemini-2.5-flash', 'gemini-1.5-flash', 'gemini-2.0-flash-exp'];
            $aiReply = null;
            $errorLog = '';

            foreach ($models as $model) {
                $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";
                
                $response = Http::withoutVerifying()->post($url, $payload);

                if ($response->successful()) {
                    $rawText = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? null;
                    if ($rawText) {
                        $aiReply = trim($rawText);
                        break;
                    }
                } else {
                    $errorLog = $response->body();
                }
            }

            // 4. Fallback dinamis jika model statis gagal
            if (!$aiReply) {
                $listRes = Http::withoutVerifying()->get("https://generativelanguage.googleapis.com/v1beta/models?key={$apiKey}");
                
                if ($listRes->successful()) {
                    $availableModels = $listRes->json()['models'] ?? [];
                    foreach ($availableModels as $m) {
                        if (in_array('generateContent', $m['supportedGenerationMethods'] ?? [])) {
                            $modelName = $m['name'];
                            $url = "https://generativelanguage.googleapis.com/v1beta/{$modelName}:generateContent?key={$apiKey}";
                            
                            $resDynamic = Http::withoutVerifying()->post($url, $payload);

                            if ($resDynamic->successful()) {
                                $rawText = $resDynamic->json()['candidates'][0]['content']['parts'][0]['text'] ?? null;
                                if ($rawText) {
                                    $aiReply = trim($rawText);
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

            // 5. Simpan log obrolan
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