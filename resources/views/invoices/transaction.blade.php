<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $transaction->invoice_code }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #111827;
            margin: 32px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 24px;
        }
        .brand {
            font-size: 24px;
            font-weight: bold;
        }
        .meta {
            text-align: right;
            font-size: 12px;
            line-height: 1.6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border-bottom: 1px solid #e5e7eb;
            padding: 10px 8px;
            text-align: left;
            font-size: 12px;
        }
        th {
            background: #f3f4f6;
        }
        .totals {
            margin-top: 24px;
            width: 260px;
            margin-left: auto;
            font-size: 13px;
        }
        .totals-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
        }
        .grand {
            font-weight: bold;
            font-size: 16px;
            border-top: 2px solid #111827;
            margin-top: 8px;
            padding-top: 8px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <div class="brand">OmniStock AI</div>
            <div style="font-size: 12px; color: #4b5563;">Inventory & Sales Management</div>
        </div>
        <div class="meta">
            <div><strong>Invoice:</strong> {{ $transaction->invoice_code }}</div>
            <div><strong>Date:</strong> {{ $transaction->created_at->format('d M Y') }}</div>
            <div><strong>Status:</strong> Completed</div>
        </div>
    </div>

    <hr style="border: 1px solid #e5e7eb; margin: 16px 0;">

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaction->details as $detail)
                <tr>
                    <td>{{ $detail->product->name ?? 'Product' }}</td>
                    <td>{{ $detail->qty }}</td>
                    <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <div class="totals-row">
            <span>Subtotal</span>
            <span>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
        </div>
        <div class="totals-row">
            <span>Tax</span>
            <span>Rp 0</span>
        </div>
        <div class="totals-row grand">
            <span>Total</span>
            <span>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
        </div>
    </div>
</body>
</html>
