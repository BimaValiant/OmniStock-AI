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
            $context = "Kamu adalah OmniBot, asisten AI analisis inventaris untuk sistem OmniStock AI. Berikut adalah data stok produk saat ini:\n";
            
            foreach ($products as $p) {
                $categoryName = $p->category->name ?? 'Uncategorized';
                $context .= "- Nama: {$p->name} | SKU: {$p->sku} | Kategori: {$categoryName} | Stok: {$p->stock} | Min Alert: {$p->min_stock_alert} | Harga Jual: Rp {$p->selling_price}\n";
            }

            // 2. Ambil API Key Gemini
            $apiKey = env('GEMINI_API_KEY');

            if (!$apiKey) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'GEMINI_API_KEY belum terpasang di file .env!'
                ], 400);
            }

            // 3. Request ke Gemini API (Pakai gemini-3.5-flash)
            $response = Http::withoutVerifying()
                ->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-3.5-flash:generateContent?key={$apiKey}", [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $context . "\nPertanyaan User: " . $userPrompt]
                            ]
                        ]
                    ]
                ]);

            if ($response->failed()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gemini API Error (' . $response->status() . '): ' . $response->body()
                ], 400);
            }

            $responseData = $response->json();
            $aiReply = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, AI tidak memberikan respon.';

            // 4. Simpan riwayat ke database
            try {
                AiChatLog::create([
                    'user_prompt' => $userPrompt,
                    'ai_response' => $aiReply,
                ]);
            } catch (\Exception $dbEx) {
                // Biarkan lanjut walau simpan log gagal
            }

            return response()->json([
                'status' => 'success',
                'reply' => $aiReply
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Backend Error: ' . $e->getMessage() . ' on line ' . $e->getLine()
            ], 500);
        }
    }
}