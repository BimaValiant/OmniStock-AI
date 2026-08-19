<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk #{{ $transaction->invoice_code ?? $transaction->id }}</title>
    <style>
        @page { size: 80mm auto; margin: 0; }
        body {
            font-family: 'Courier New', Courier, monospace;
            width: 78mm;
            margin: 0 auto;
            padding: 10px;
            font-size: 11px;
            color: #000;
            background: #fff;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .bold { font-weight: bold; }
        .line { border-bottom: 1px dashed #000; margin: 8px 0; }
        table { width: 100%; border-collapse: collapse; }
        td, th { padding: 3px 0; vertical-align: top; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="no-print" style="margin-bottom: 15px; text-align: center;">
        <button onclick="window.print()" style="padding: 6px 12px; cursor: pointer;">🖨️ Cetak Struk</button>
        <button onclick="window.close()" style="padding: 6px 12px; cursor: pointer;">❌ Tutup</button>
    </div>

    <div class="text-center">
        <h2 style="margin: 0; font-size: 15px;" class="bold">OMNISTOCK AI</h2>
        <p style="margin: 2px 0;">Enterprise Inventory & POS</p>
        <p style="margin: 0;">Telp: 0812-3456-7890</p>
    </div>

    <div class="line"></div>

    <table>
        <tr>
            <td>No. Invoice</td>
            <td class="text-right bold">{{ $transaction->invoice_code ?? 'INV-'.$transaction->id }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td class="text-right">{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td class="text-right bold">{{ strtoupper($transaction->status) }}</td>
        </tr>
    </table>

    <div class="line"></div>

    <table>
        <thead>
            <tr style="border-bottom: 1px solid #000;">
                <th style="text-align: left;">Item</th>
                <th style="text-align: center;">Qty</th>
                <th style="text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->details as $detail)
                <tr>
                    <td>{{ $detail->product->name ?? 'Produk' }}</td>
                    <td class="text-center">{{ $detail->qty }}</td>
                    <td class="text-right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="line"></div>

    <table>
        <tr class="bold" style="font-size: 12px;">
            <td>TOTAL</td>
            <td class="text-right">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="line"></div>

    <div class="text-center" style="margin-top: 15px;">
        <p style="margin: 0;">-- Terima Kasih --</p>
        <p style="margin: 2px 0;">Barang yang sudah dibeli</p>
        <p style="margin: 0;">tidak dapat ditukar/dikembalikan</p>
    </div>
</body>
</html>